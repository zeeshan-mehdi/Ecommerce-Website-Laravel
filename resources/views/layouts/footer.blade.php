

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        footer {
            margin-top: 600px;
            background: black;
            height: 250px;
        }

        #text {
            color: white;
            margin-left: 50px;
            display: inline-block;
        }

        h1 {
            font-size: 20px;
            padding-top: 20px;
        }

        a {
            font-size: 13px;
            font-family: sans-serif;
        }

        a:hover {
            cursor: pointer;
            border-bottom: 1px solid white;
            transition: 0.9s all;
        }

        #about {
            color: white;
            display: inline-block;
            margin-left: 50px;
        }

        #appStore{

            display: inline-flex;
            margin-left: 500px;
            width: 140px;
            height: 40px;
            font-size: 15px;
            background: black;
            color: white;
            border-radius: 5px;
        }
        
        #appStore img{
            float: left;
        }




        #playStore{

            display: inline-flex;
            margin-left: 10px;
            width: 120px;
            height: 40px;
            font-size: 15px;
            background: black;
            color: white;
            border-radius: 5px;
        }

        #playStore img{
            float: left;
        }

        #buttons button,label:hover{
            cursor: pointer;
        }


    </style>
<footer>
    <div class="row">
        <div id="text" class="col">
            <h1>Customer Care</h1>

            <br><a>Help Center</a><br>
            <a>How To Buy</a><br>
            <a>Track Order</a><br>
            <a>Return And Refunds</a><br>
            <a>Contact Us</a><br>

        </div>

        <div id="about" class="col">
            <h1>AFFLATOON GROUP</h1>
            <br><a>About Us</a><br>
            <a>Digitak Payments</a><br>
            <a>Carriers</a><br>
            <a>Terms And Conditions</a><br>
            <a>Privacy Policy</a><br>
        </div>
    </div>

    <div id="buttons" class="row">

        <button id="appStore">
            <img src="{{asset('storage/images/apple.png')}}" width="30px" height="36px">
           Download On The App Store

        </button>

        <button id="playStore">
            <img src="{{asset('storage/images/playstore.jpg')}}" width="30px" height="36px">

            Get It On Play Store
        </button>

    </div>




</footer>