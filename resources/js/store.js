import Axios from "axios";

export default{
    strict:true,
    state:{
        rel_sections:[],
        sections:[],
        current_course:{id:6},
    },
    getters:{
        sections(state){
            return state.sections;
        },
        curriculum_course_id(state){
            return state.current_course.id;
        }
    },
    mutations:{
        update_section_title(state, payload){         
            const section = state.sections.find(section => {
                return section.id == payload.section_id
            });
            section.title = payload.section_title;
        },

        //Lecture methods
        store_lecture_title(state, payload){
            state.rel_sections = payload.lecture_title;
        }
    },
    actions:{
      load_sections({commit}){
        const id = this.state.current_course.id;
        Axios.post(`/get-curriculum/${id}`)
        .then(response => {
            const sec_data = response.data;
            commit('GET_SECTIONS', sec_data);
            console.log(sec_data);
        })
        .error(error=>(console.log(error)))
      }  
    }
}