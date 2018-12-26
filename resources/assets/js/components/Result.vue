<template>
    <div>
        <h6 class="text-center text-info">{{course.course_code}}-{{course.course_title}} Result</h6>

        <div class="form-group">
            <label for="view-result">Select by Session </label>
            <select  v-for="test in tests" id="view-result"  class="form-control">
                <option>Available results</option>
                <option  v-bind:value="test.id"  @select="fetchResult(test.id)" @click="fetchResult(test.id)">{{test.session}}</option>
            </select>
        </div>
        <div id="view_result_status" class="text-danger text-center"></div>

        <table id="view-result_table" class="table table-responsive-sm table-striped">
            <thead>
            <tr>
                <th>Surname</th>
                <th>First Name</th>
                <th>Reg no</th>
                <th>Score</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
            <tr>
                <th>Surname</th>
                <th>First Name</th>
                <th>Reg no</th>
                <th>Score</th>
                <th>Total</th>
            </tr>
            </tfoot>
        </table>
        {{test_results}}
    </div>


</template>
<script>

    export default{
        props: {
            'm_test': Array,
            'm_course':Object


        },
        mounted (){
            this.tests= this.m_test;
            this.course= this.m_course;

        },
        data() {
            return{
                'resultAvailable':false,
                'test_results':[],
                'tests':[],
                'course':[]

            }
        },

        created(){


        },

        methods:{

            fetchResult: function(id){

                fetch('lecturer/view_result/'+id)
                    .then(res => res.json())
            .then(res => {
                    this.test_results = res;
            })
            .catch(err => console.log(err));
            }



        }



    }
</script>