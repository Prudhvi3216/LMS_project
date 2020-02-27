import Axios from "axios";

export default{
    strict:true,
    state:{
        test_sections:[],
        section_data:[],
        current_course:{id:6},
    },
    getters:{
        sections(state){
            return state.test_sections;
        },
        curriculum_course_id(state){
            return state.current_course.id;
        },
        section_title(state, section_index){
            return state.test_sections[section_index].section_title;
        }
    },
    mutations:{
        update_section_title(state, payload){         
            const section = state.sections.find(section => {
                return section.id == payload.section_id
            });
            section.title = payload.section_title;
        },

        //Sections
        sections(state, sec_data){
            state.section_data = sec_data;
        },

    },
    actions:{

      load_sections({commit}){
        const id = this.state.current_course.id;
        Axios.post(`/get-curriculum/${id}`)
        .then(response => {
            const sec_data = response.data;
            commit('SECTIONS', sec_data);
        })
        .error(error=>(console.log(error)))
      }, 


      insert_section_data(section_index){
            console.log(section_index);
            const url = '/add-section';
            Axios.post(url,section_data)
                .then(response=>{
                    const data = response.data;
                    /*
                    this.test_sections[section_index].alert_type = response.data.alert_type;
                    if(response.status == 200){
                        this.test_sections[section_index].title_insert_show = false;
                        this.test_sections[section_index].title_edit_show = true;
                        this.test_sections[section_index].editing = false;
                        this.test_sections[section_index].section_id = response.data.section_inserted_id;
                    } 
                    */
                })
                .catch(error=>{
                    console.log(error);
                });
        }

    },

    

}