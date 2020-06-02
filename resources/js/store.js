import Axios from "axios";
import router from './routes';

//Axios.defaults.baseURL = 'http://35.223.76.203/';
Axios.defaults.baseURL = 'http://127.0.0.1:8000/';

export default{
    strict:true,
    state:{
        token: localStorage.getItem('access_token') || null,
        user: null,

        //Curriculum state variables
        sections:[],
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
        },

        //Curriculum Mutations
        new_section(state, new_section){
            state.sections.push(new_section);
        },
        new_lecture(state,payload){
            state.sections[payload.section_index].lectures.push(payload.new_lecture);
        },

        cancel_section(state, payload){
            state.sections.splice(payload.section_index,1);
        },

        cancel_lecture(state, payload){
            state.sections[payload.section_index].lectures.splice(payload.lecture_index,1);
        },

        updateSectiontitle(state, payload){
            console.log(section_title);
        }

    },
    actions:{

        //Authencation Actions
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

        //Curriculum Actions
        new_section(context){
            const new_section = {
                section_title:'',
                sort_order:'',
                lectures:[],

            };
            context.commit('new_section',new_section);
        },

        new_lecture(context,payload){
            const new_lecture = {
                title:'',
                description:'',
                contenttext:'',
                media:'',
                media_type:'',
                sort_order:'',
                publish:'',
                file:'',

                uploadPercentage:0,
                uploaded_file_title:'',
                uploaded_file_size:'',
                
                show_file_details:false,
                show_progress:false,
                show_description:false,
                show_contenttext:false,
                show_dropzone:false,

                show_delete_lecture_button:false,
                show_cancel_lecture_button:true,
            };
            const section_index = payload.section_index;
            context.commit('new_lecture',{new_lecture,section_index});
        },

        cancel_section(context,payload){
            const section_index = payload.section_index;
            context.commit('cancel_section',{section_index});
        },

        cancel_lecture(context,payload){
            const section_index = payload.section_index;
            const lecture_index = payload.lecture_index;
            context.commit('cancel_lecture',{section_index,lecture_index});
        },

        insert_section_title(context,payload){
            const section_index = payload.section_index;
            const section_title = payload.section_title;
            const course_id = payload.course_id;
            const url = '/api/instructor/add-section';
            Axios.post(url,{
                'course_id' : course_id,
                'section_title' : section_title
            })
            .then(response=>{
                console.log(response.data);
                //const section_title = response.data.section_title;
                //context.commit('updateSectiontitle', {section_title});               
            })
            .catch(error=>{
                console.log(error);
            });
        }

    },
}