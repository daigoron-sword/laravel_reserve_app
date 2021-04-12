<section class="contactDetails">
    <div class="container"> 
    <div class="heading">
        <h2>Drop a email</h2>
        <h3>Please feel free if you would like to have a chat.</h3>       
      </div>
      <!--contact form start-->
      <div class="row media">      	 
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 conForm text-center">
        <div id="message"></div>
        <form method="post" action="php/contact.php" name="cform" id="cform">
          <input name="name" id="name" type="text" class="col-xs-12 col-sm-12 col-md-8 col-lg-8" placeholder="Your name" >
          <input name="email" id="email" type="email" class=" col-xs-12 col-sm-12 col-md-8 col-lg-8 noMarr" placeholder="Your email" >
          <textarea name="comments" id="comments" cols="" rows="" class="col-xs-12 col-sm-12 col-md-8 col-lg-8" placeholder="Your message"></textarea>
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><input type="submit" id="submit" name="send" class="submitBnt" value="Send message"></div>
          <div id="simple-msg"></div>
        </form>
      </div>
      </div>
      <!--contact form end--> 
    </div>
  </section>  
  <!--contact end--> 
