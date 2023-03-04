<!-- Chat bot Modal  -->
<div class="modal fade"  id="chatBotModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"  role="document" >
            <div class="modal-content" id="bot">
                <div id="container">
                    <div id="header">
                        Serenidad Suites Chatbot
                    </div>
                
                    <div id="body" >
                        <!-- This section will be dynamically inserted from JavaScript -->
                        <div class="botSection">
                            <div class="messages"> </div>
                            <!-- <div class="seperator"></div> -->
                        </div>
                        <div class="userSection">
                            <div class="messages"></div>
                            <!-- <div class="seperator"></div> -->
                        </div>                
                    </div>
                
                    <div id="inputArea">
                    <form class="" onsubmit="event.preventDefault();"  >
                        <input style="display: inline; width: 70%;" type="text" name="messages" id="userInput" placeholder="Please enter your message here" required>  
                        <input style="display: inline;" class="btn btn-sm" id="send" type="submit" value="Send" />
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik&display=swap');
      /* Style the outer container. Centralize contents, both horizontally and vertically */
      .mainBody{
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: "Rubik", sans-serif;
        }
      #bot {
        margin: 50px 0;
        height: 700px;
        width: 600px;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 3px 3px 15px rgba(0, 0, 0, 0.2) ;
        border-radius: 20px;
      }

      /* Make container slightly rounded. Set height and width to 90 percent of .bots' */
      #container {
        height: 90%;
        border-radius: 6px;
        width: 90%;
        background: #F3F4F6;
      }

      /* Style header section */
      #header {
        width: 100%;
        height: 10%;
        border-radius: 6px;
        background: #3B82F6;
        color: white;
        text-align: center;
        font-size: 2rem;
        padding-top: 12px;
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
      }

      /* Style body */
      #body {
        width: 100%;
        height: 75%;
        background-color: #F3F4F6;
        overflow-y: auto;
      }

      /* Style container for user messages */
      .userSection {
        width: 100%;
      }

      /* Seperates user message from bot reply */
      .seperator {
        width: 100%;
        height: 50px;
      }

      /* General styling for all messages */
      .messages {
        max-width: 60%;
        margin: .5rem;
        font-size: 1.2rem;
        padding: .5rem;
        border-radius: 7px;
      }

      /* Targeted styling for just user messages */
      .user-message {
        
        text-align: right;
        background: #E5E7EB;
        margin-top: 1rem;
        float: right;
        color: black;
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
      }

      /* Targeted styling for just bot messages */
      .bot-reply {
        margin-top: 1rem;
        text-align: left;
        background: #3B82F6;
        color: white;
        float: left;
      }

      /* Style the input area */
      #inputArea {
        /* display: flex;
        align-items: center;
        justify-content: center;
        height: 10%; */
        padding: 1rem;
        background: transparent;
      }

      /* Style the text input */
      #userInput {
        height: 20px;
        width: 80%;
        background-color: white;
        border-radius: 6px;
        padding: 1rem;
        font-size: 1rem;
        border: none;
        outline: none;
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
      }

      /* Style send button */
      #send {
        height: 50px;
        padding: .5rem;
        font-size: 1rem;
        text-align: center;
        width: 20%;
        color: white;
        background: #3B82F6;
        cursor: pointer;
        border: none;
        border-radius: 6px;
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
      }

      /* Style the form - display items horizontally */
      .form-inline {
        display: flex;
        flex-flow: row wrap;
        align-items: center;
      }

      /* Add some margins for each label */
      .form-inline label {
        margin: 5px 10px 5px 0;
      }

      /* Style the input fields */
      .form-inline input {
        vertical-align: middle;
        margin: 5px 10px 5px 0;
        padding: 10px;
        background-color: #fff;
        border: 1px solid #ddd;
      }

      /* Style the submit button */
      .form-inline button {
        padding: 10px 20px;
        background-color: dodgerblue;
        border: 1px solid #ddd;
        color: white;
      }

      .form-inline button:hover {
        background-color: royalblue;
      }

  </style>