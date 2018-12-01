<template>
   <div>
     <div class="form-group text-center">
      <label for="go_to">Go to question</label>
      <input  id="no" type="number" min="1" v-bind:max="testQuestions.length"  v-bind:value="current_question_no+1" class="form-control-sm"  @keyup="goTo(),visible()" @change="goTo(),visible()">
     <!-- <button class="btn btn-sm btn-dark" id="go_to"><i class="fa fa-arrow-left"></i><i class="fa fa-arrow-right"></i></button>-->
      </div>
      <div id="question" v-for="(testQuestion,index) in testQuestions">
      <div v-bind:id="testQuestion.id" v-show="index===current_question_no">      
      <p>{{current_question_no+1}}: {{testQuestion.question}}</p>
      <ol type="A">

      <li>
      <label><input type="radio" v-bind:name="testQuestion.id" value="a"
       @click="studentResponse(testQuestion.id,'a')" 
       @change= "studentResponse(testQuestion.id,'a')"> {{testQuestion.a}}</label>
      </li>

      <li>
      <label><input type="radio" v-bind:name="testQuestion.id"  value="b"
       @click="studentResponse(testQuestion.id,'b')"
       @change= "studentResponse(testQuestion.id,'b')"> {{testQuestion.b}}</label>
      </li>

      <li>
      <label><input type="radio" v-bind:name= "testQuestion.id" value="c" 
      @click="studentResponse(testQuestion.id,'c')"
      @change= "studentResponse(testQuestion.id,'c')"> {{testQuestion.c}}</label>
      </li>

      <li>
      <label><input type="radio" v-bind:name="testQuestion.id" value="d" 
      @click="studentResponse(testQuestion.id,'d')"
      @change= "studentResponse(testQuestion.id,'d')">
       {{testQuestion.d}}</label>
      </li> 

      </ol>
      </div>
      </div>
       <span>
      <p class="text-center"> 
      <button class="btn btn-sm btn-info float-left" v-if="prev_seen" @click="prev(),visible()" id="prev" >< Prev</button>
       <span class="text-center text-secondary">Attempted {{studentResponses.size}} of {{testQuestions.length}} questions.</span>
       <button class="btn btn-sm btn-info  float-right" v-if="next_seen" @click="next(),visible()" id="next">Next ></button>
       </p>

       <p class="text-center"><button id="submit" class="btn btn-lg btn-danger" @click="submitTest()">Submit <i class="fa fa-lock"></i></button></p>

       </span>

    </div>
</template>
<script>

 export default{
    props: {
                duration: Object
            },
         mounted (){
             //console.log(this.duration.date);
             let d = this.duration.date;
             let a= this.studentResponses;
             this.timer(d);


                    },
    data() {
        return{
            current_question_no : 0,
            prev_seen : false,
            next_seen : true,
            testQuestions : [],           
            studentResponses: new Map(),
            endTime : ""

        }
    },

    created(){
        this.fetchQuestion();
         window.addEventListener("beforeunload",function (e){
                let message = "if you refresh or leave this page, your response (data) will be lost while your time still counts down";
                (e || window.event).returnValue = message;
                return message;

            });





        },

     methods:{

         fetchQuestion(){
            let ids = [];
            this.question_ids= ids;
            fetch('api/question')
                .then(res => res.json())
                .then(res => {
                    this.testQuestions = res;
                    
                    })
                     
                
                .catch(err => console.log(err));
         },

         visible () {
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


         next(){

            let current_question_no = this.current_question_no;
            if(current_question_no < this.testQuestions.length-1){
               current_question_no+=1;



             }

         this.current_question_no = current_question_no;
         //localStorage.setItem('no',current_question_no)

         },
         prev(){
            let current_question_no = this.current_question_no;
            if(current_question_no >0 ){
              current_question_no-=1;
             }
            this.current_question_no = current_question_no;
            // localStorage.setItem('no',current_question_no)


         },
         goTo(){
            let input = $('#no').val();
            if (input >=1 && input <= this.testQuestions.length){
                this.current_question_no = input-1;
            }


         },
         submitTest(){
            let response = confirm("Are you ready to submit the test?");
            


            if (response===true){
                  this.submit();
                
            }

         },

        submit(){
         	let ids = this.getResponseIds();
            let options= this.getResponseOptions(); 
            let token = window.Laravel.csrfToken;


            $.ajax({
                	type: 'POST',
                	url: '/test/submit',
                	data : { _token:token, question_id:ids, option:options},
             
                	complete: function(){
                	
                	},
                	success:function(result){
                      alert(JSON.stringify(result));
                	} 


                });


        },
         studentResponse(id,option){
         	this.studentResponses.set(id,option);
            //console.log(this.strMapToObj(this.studentResponses));
            console.log(this.studentResponses);

			 
			
         },

        
         getResponseIds(){
         
         let ids= [];
        
         	this.studentResponses.forEach(function(values,keys){
          	 	ids.push(keys);
          	 	

          	 })


           return ids;


         },

          getResponseOptions(){
         
         
            let response= [];
         	this.studentResponses.forEach(function(values,keys){
         
          	 	response.push(values);

          	 })


      		return response;


         },

          mapToJson (map){
         	return JSON.stringify([...map])
         },

          jsonToMap (jsonStr){
         	return  new Map (JSON.parse(jsonStr))
         },

         strMapToObj (strMap){
         	let obj = Object.create(null);
         	for(let[k,v] of strMap){
         	obj[k]=v;
         	}
         	return obj;

         } ,
         strMapToJson(strMap) {
         	return JSON.stringify(this.strMapToObj(strMap));

         },
         timer(endTime){
             // Set the date we're counting down to
             //var countDownDate
             var d= "Nov 27, 2018 20:44:00";
             localStorage.setItem('countDownDate', new Date("Nov 27, 2018 20:44:00").getTime());

             // Update the count down every 1 second
             var x = setInterval(function() {


                 // Get todays date and time
                 var now = new Date().getTime();

                 // Find the distance between now and the count down date
                 localStorage.setItem('distance',localStorage.getItem('countDownDate') - now);

                 // Time calculations for days, hours, minutes and seconds
                 var days = Math.floor(localStorage.getItem('distance') / (1000 * 60 * 60 * 24));
                 var hours = Math.floor((localStorage.getItem('distance') % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                 var minutes = Math.floor((localStorage.getItem('distance') % (1000 * 60 * 60)) / (1000 * 60));
                 var seconds = Math.floor((localStorage.getItem('distance') % (1000 * 60)) / 1000);

                 // Display the result in the element with id="demo"
                 document.getElementById("demo").innerHTML = hours + "h "
                 + minutes + "m " + seconds + "s ";

                 // If the count down is finished, write some text
                 if (localStorage.getItem('distance') <= 0) {
                     clearInterval(x);
                     document.getElementById("demo").innerHTML = "EXPIRED";

                 }

             }, 1000);



         }






     }

 }
</script>