<template>
<nav class="navbar  navbar-dark bg-dark">
    <a class="navbar-brand" href="#">CBT</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="#">
                <p id="demo" class="float-right text-danger" v-if="testQuestions"></p>

            </a>
        </li>
    </ul>
</nav>
</template>
<script>
    export default{
        props: {

            start_time:  String,
            end_time: String

        },
        mounted (){

            this.endTime= this.end_time;
            this.startTime= this.start_time;



        },
        data() {
            return{
                startTime:'',
                endTime : ''

            }
        },

        created(){
            this.timer(new Date(this.end_time).getTime());
        },

        methods: {
            timer : function(endTime){
                // Set the date we're counting down to

                var countDownDate = new Date(endTime).getTime();

                // Update the count down every 1 second
                var x = setInterval(function() {


                    // Get todays date and time
                    var now = new Date().getTime();

                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Display the result in the element with id="demo"
                    document.getElementById("demo").innerHTML = "Exam ends at: "+hours + "h "
                        + minutes + "m " + seconds + "s ";

                    // If the count down is finished, write some text
                    if (distance <= 0) {
                        clearInterval(x);
                        document.getElementById("demo").innerHTML = "EXPIRED";


                    }

                }, 1000);



            }

        }


    }

</script>