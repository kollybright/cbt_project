<template>
 <div v-if="showQuestions">
  <p class="text-danger float-right big-text" id="demo"></p>
  <div class="form-group text-center">
   <label for="no">Go to question</label>
   <input  id="no" type="number" min="1" v-bind:max="testQuestions.length"  v-bind:value="current_question_no+1" class="form-control-sm"  @keyup="goTo(),visible()" @change="goTo(),visible()">
   <!-- <button class="btn btn-sm btn-dark" id="go_to"><i class="fa fa-arrow-left"></i><i class="fa fa-arrow-right"></i></button>-->
  </div>
  <div id="question" v-for="(testQuestion,index) in testQuestions">
   <div v-bind:id="testQuestion.id" v-show="index===current_question_no">
    <p><b>Q{{current_question_no+1}}</b>: {{testQuestion.question}}</p>
    <ul style="list-style: none">

     <li class="mb-1">
      <label>A. <input type="radio" v-bind:name="testQuestion.id" value="a"
                       @click="studentResponse(testQuestion.id,'a')"
                       @change= "studentResponse(testQuestion.id,'a')"> {{testQuestion.a}}</label>
     </li>

     <li class="mb-1">
      <label>B. <input type="radio" v-bind:name="testQuestion.id"  value="b"
                       @click="studentResponse(testQuestion.id,'b')"
                       @change= "studentResponse(testQuestion.id,'b')"> {{testQuestion.b}}</label>
     </li>

     <li class="mb-1">
      <label>C. <input type="radio" v-bind:name= "testQuestion.id" value="c"
                       @click="studentResponse(testQuestion.id,'c')"
                       @change= "studentResponse(testQuestion.id,'c')"> {{testQuestion.c}}</label>
     </li>

     <li class="mb-1">
      <label>D. <input type="radio" v-bind:name="testQuestion.id" value="d"
                       @click="studentResponse(testQuestion.id,'d')"
                       @change= "studentResponse(testQuestion.id,'d')" > {{testQuestion.d}} </label>
     </li>

    </ul>
   </div>
  </div>
  <div>
   <p class="text-center">
    <button class="btn btn-sm btn-info float-left" v-if="prev_seen" @click="prev(),visible()" id="prev" >< Prev</button>
    <span class="text-center text-secondary">Attempted {{studentResponses.size}} of {{testQuestions.length}} questions.</span>
    <button class="btn btn-sm btn-info  float-right" v-if="next_seen" @click="next(),visible()" id="next">Next ></button>
   </p>

   <p class="text-center"><button id="submit" class="btn btn-sm btn-danger" @click="submitTest()">Submit <i class="fa fa-lock"></i></button></p>

  </div>
 </div>

  <div v-else id="countdown" class="text-lg-center text-danger"></div>




</template>
<script>

    export default{
        props: {
            questions: String,
            id:  String,
            start_time:  String,
            end_time: String

        },
        mounted (){
            this.testQuestions= JSON.parse(this.questions);
            this.endTime= this.end_time;
            this.startTime= this.start_time;
            this.test_id= this.id;


        },
        data() {
            return{
                current_question_no : 0,
                prev_seen : false,
                next_seen : true,
                testQuestions : [],
                studentResponses: new Map(),
                test_id:'',
                startTime:'',
                endTime : '',
                showQuestions:false,
                takingTest:false


            }
        },

        created(){

            setInterval(this.showQuestion,1000);
            this.countdown(new Date(this.start_time).getTime());
            this.timer(new Date(this.end_time).getTime());
            window.addEventListener("beforeunload",this.warning);



        },
        methods:{
           warning: function(e){
                   let message = "if you refresh or leave this page, your response (data) will be lost while your time still counts down";
                   (e || window.event).returnValue = message;
                   return message;

               },
            showQuestion: function(){
                let now = new Date().getTime();
                let start=new Date (this.startTime).getTime();
                let end= new Date(this.endTime).getTime();

                if( now >= start && now <= end ){
                    this.showQuestions= true;
                }
                else{
                    this.showQuestions= false;

                }


            },



            visible: function () {
                let prev_seen = this.prev_seen;
                let next_seen = this.next_seen;
                let current_question_no =this.current_question_no;
                let last_question_no = this.testQuestions.length - 1;

                if (current_question_no > 0 ){
                    prev_seen=true;
                }
                else{
                    prev_seen=false;
                }
                if (current_question_no == last_question_no){
                    next_seen=false;
                }
                else{
                    next_seen=true;
                }
                this.next_seen = next_seen;

                this.prev_seen = prev_seen;

            },


            next: function(){

                let current_question_no = this.current_question_no;
                if(current_question_no < this.testQuestions.length-1){
                    current_question_no+=1;



                }

                this.current_question_no = current_question_no;
                //localStorage.setItem('no',current_question_no)

            },
            prev: function(){
                let current_question_no = this.current_question_no;
                if(current_question_no >0 ){
                    current_question_no-=1;
                }
                this.current_question_no = current_question_no;
                // localStorage.setItem('no',current_question_no)


            },
            goTo: function(){
                let input = $('#no').val();
                if (input >=1 && input <= this.testQuestions.length){
                    this.current_question_no = input-1;
                }


            },
            submitTest: function(){
                let response = confirm("Are you ready to submit the test?");
                if (response===true){
                    this.submit();

                }

            },

            submit: function(){
                // let ids = this.getResponseIds();
                // let options= this.getResponseOptions();
                let test_id = this.test_id;
                let responses= this.mapToJson(this.studentResponses);
                let token = window.Laravel.csrfToken;
                let total= this.testQuestions.length;
                let _this= this;

                $.ajax({
                    type: 'POST',
                    url: '/test/submit',
                    data : { _token:token, responses:responses,test_id:test_id, total:total},
                    // complete: function(){
                    //     $('#ajax-response').html('Your response have been submitted')
                    // },
                    success:function(){
                        window.removeEventListener("beforeunload",_this.warning);
                        _this.takingTest=false;
                        $('#submitted').click();
                        window.location= "http://localhost:8000/student/logout";
                    }


                });


            },
            studentResponse: function (id,option){
                this.studentResponses.set(id,option);
                this.takingTest = true;
                //console.log(this.strMapToObj(this.studentResponses));
                // console.log(this.studentResponses);



            },


            getResponseIds: function(){

                let ids= [];

                this.studentResponses.forEach(function(values,keys){
                    ids.push(keys);


                });


                return ids;


            },

            getResponseOptions: function(){


                let response= [];
                this.studentResponses.forEach(function(values,keys){

                    response.push(values);

                });


                return response;


            },

            mapToJson: function (map){
                return JSON.stringify([...map])
            },

            jsonToMap:function (jsonStr){
                return  new Map (JSON.parse(jsonStr))
            },

            strMapToObj: function (strMap){
                let obj = Object.create(null);
                for(let[k,v] of strMap){
                    obj[k]=v;
                }
                return obj;

            } ,
            strMapToJson : function(strMap) {
                return JSON.stringify(this.strMapToObj(strMap));

            },
            countdown: function (time) {
                // Set the date we're counting down to
                //var countDownDate

                // Update the count down every 1 second
                var x = setInterval(function() {


                    // Get todays date and time
                    var now = new Date().getTime();

                    // Find the distance between now and the count down date
                    var distance = time - now;
                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Display the result in the element with id="demo"



                    $('#countdown').html('Countdown to test' + "<br>"+ "<i class='fa fa-hourglass-half'></i> " + days + 'd: ' + hours + 'h: ' + minutes + 'm: ' + seconds + 's');

                    // If the count down is finished, write some text
                    if (distance <= 0) {
                        clearInterval(x);
                        $('#countdown').html('Expired, the test has been taken already.');

                        // document.getElementById('countdown').innerHTML='Expired, the test has been taken already';

                    }

                }, 1000);



            },
            timer : function(endTime){
                // Set the date we're counting down to


                let countDownDate = new Date(endTime).getTime();

                // Update the count down every 1 second
                let _this =  this;
                let x = setInterval(function() {


                    // Get todays date and time
                    let now = new Date().getTime();

                    // Find the distance between now and the count down date
                    let distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Display the result in the element with id="demo"


                    $('#demo').html("<i class='fa fa-hourglass-half'></i> " +hours + "h " + minutes + "m " + seconds + "s ");


                    // If the count down is finished, write some text
                    if (distance <= 0 ) {
                        clearInterval(x);
                        $('#countdown').html('Expired, the test has been taken already.');
                        if( _this.takingTest===true){
                            _this.submit();
                        }
                        // $('#demo').html('EXPIRED');
                    }



                }, 1000);



            }
            //


        }

    }
</script>
