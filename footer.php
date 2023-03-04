  <?php
    include_once('chatbotModal.php');
  ?>
  
  <!-- Floating Action Button -->
  <span  data-toggle="modal" data-target="#chatBotModal" >
    <a href="#" class="float" data-toggle="tooltip" data-placement="left" title="Chat with us!">
      <i class="my-float" data-feather="message-square"></i>
    </a>
  </span>
  <!-- Floating Action Button -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="vendor/holder.min.js"></script>
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

  </body>

  <style>
	
.float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#3a60ce;
	color:#FFF;
	border-radius:50px;
	text-align:center;
	z-index: 99;
}

.my-float{
	margin-top:18px;
}
</style>
</html>
