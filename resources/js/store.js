import Axios from "axios";
import router from './routes';

Axios.defaults.baseURL = 'http://127.0.0.1:8000/';

export default{
    strict:true,
    state:{
        token: localStorage.getItem('access_token') || null,
        user: null,
    },
    getters:{

        loggedIn(state){
           return state.token !== null;
        },
        user(state){
            return state.user;
        }

    },
    mutations:{

        retriveToken(state, token){
            state.token = token;
        },
        retriveUser(state, user){
            state.user = user;
        },
        destroyToken(state){
            state.token = null
            state.user = null
        }

    },
    actions:{

        retriveToken(context,credentials){
            const url = '/api/login';
            Axios.post(url,{
                email:credentials.email,
                password:credentials.password,
                remember:credentials.remember
            })
            .then(response=>{                
                if(response.data.req_status == 'success'){
                    const token = response.data.access_token;
                    localStorage.setItem('access_token',token);
                    context.commit('retriveToken',token);
                    router.push({ name: 'home-page' });
                }
            })
            .catch(error=>{
                console.log(error);
            });
        },

        retriveUser(context){
            const url = '/api/user';
            Axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token
            Axios.get(url)
            .then(response=>{                
                if(response.data.req_status == 'success'){
                    const user = response.data.user;
                    context.commit('retriveUser',user);
                }
            })
            .catch(error=>{
                console.log(error.response.data);
            });
        },

        destroyToken(context){
            if(context.getters.loggedIn){
                const url = '/api/logout';
                Axios.get(url)
                .then(response=>{                
                    localStorage.removeItem('access_token');
                    context.commit('destroyToken');
                    //router.push({ name: 'home-page' });
                })
                .catch(error=>{
                    localStorage.removeItem('access_token');
                    context.commit('destroyToken');
                    console.log(error);
                });
            }
        },

    },
}