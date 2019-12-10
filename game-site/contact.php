<?php
session_start();
  // indhenter alt fra "header.php" siden, super god metode for at spare tid, og gør det lettere for os!
  require "header.php";

?>
<main>
  <!-- Kontakt formen -->
<div class="wrapper-main">
<section class="section-default">
<h1>Got any questions? Reach out to us!</h1>

<form class="contact-form" action="includes/contact-form.inc.php" method="post">
<input name="name" type="text" placeholder="Full Name">
<input name="mail" type="text" placeholder="Your Email">
<input name="subject" type="text" placeholder="Your subject">
<textarea name="message"  placeholder="Your message" ></textarea>
<button type="submit" name="submit">Send Message</button>
</form>
</section>
</div>

</main>
























<?php
 // Det samme bliver gjort i footeren som i headeren. Hurtigere og lettere for kodning.
  require "footer.php";

?>