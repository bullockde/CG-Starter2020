<section class="footer-call-to-action loading"><!-- footer call to action starts -->

<section class="container">

<div class="three-fourth">

	<h4 class="tagline">Let Us Show You What Bencardino Can Do.</h4>

</div>

<div class="one-fourth">

	<a href="<? echo $root; ?>louis-a-bencardino-excavating/contact-us" id=cu class="button huge round contact-button" >CONTACT US</a>

</div>

</section>

</section><!-- footer call to action ends -->

<footer id="footer" class="loading"><!--footer starts -->

<section class="container">

<section class="one-third">

<h4>Latest Dirt</h4>

<ul>

	<?php

			

			//$postobj = new Posts();

			//$post = $postobj->get_posts(null, null);

			//print_r($post);

			$count = count($post['id']);

			$home_url = $root.'index.php';

			$blog_url = $root.'latest-dirt/';

			$post_count = 0;

			

			for ($i=0;$i<$count;$i++)

			{

				if($post['kind'][$i] == '0' && $post_count < 5)

				{

					$ts = strtotime($post['modified'][$i]);	

					$img_arr = unserialize($post['image'][$i]);

					$post_url = $root.'latest-dirt/'.$post['id'][$i].'/'.str_replace(' ','-',$post['title'][$i]);

					$img_url = $root.'admin/uploads/'.$img_arr[0];	

					$post_title = $post['title'][$i];

					$post_date = date('d M, Y',$ts);

					$post_tag = $post['tag'][$i];

					$post_summary = $post['summary'][$i];

				?>

					<li><a href="<?php echo $post_url ?>"><?php echo $post_title ?></a></li>

				<?php

					$post_count++;

				}

			}

	?>

</ul>

</section>

<section class="one-third">

<h4>Recent Projects</h4>

<ul>

	<?php

			

			//$postobj = new Projects();

			//$post = $postobj->get_projects(null, null);

			//print_r($post);

			$count = count($post['id']);

			$home_url = $root.'index.php';

			$blog_url = $root.'louis-a-bencardino-excavating-projects/';

			$post_count = 0;

			

			for ($i=0;$i<$count;$i++)

			{

				if($post_count < 5)

				{

					$ts = strtotime($post['modified'][$i]);	

					$img_arr = unserialize($post['image'][$i]);

					$post_url = $root.'louis-a-bencardino-excavating-projects/'.$post['id'][$i].'/'.str_replace(' ','-',$post['title'][$i]);

					$img_url = $root.'admin/uploads/'.$img_arr[0];	

					$post_title = $post['title'][$i];

					$post_date = date('d M, Y',$ts);

					$post_tag = $post['tag'][$i];

					$post_summary = $post['summary'][$i];

				?>

					<li><a href="<?php echo $post_url ?>"><?php echo $post_title ?></a></li>

				<?php 

					$post_count++;

				}

			}

	?>

</ul>

<!-- lastest posts widget ends-->

</section>

<section class="one-third">

<h4>Flickr Photos</h4>

<div class="flickr-widget">

	<!-- flickr widget starts-->

</div>

</section>

</section>

</footer>

<section id="copyrights" class="loading">

<section class="container">

<div class="one-half">

	<ul class="copyright_links">

		<li><a href="<? echo $root; ?>">Home</a></li>

		<li><a href="<? echo $root; ?>louis-a-bencardino-excavating/contact-us">Contact Us</a></li>

        <li><a href="<? echo $root; ?>careers">Careers</a></li>

		<li><a href="<? echo $root; ?>louis-a-bencardino-excavating/privacy">Privacy Policy</a></li>

	</ul>

</div>

<div class="one-half">

	<ul class="social-links">

		<li><a href="https://www.facebook.com/Bencardino-Excavating/posts" class="tooltip1" title="Facebook" target="_blank"><i class="icon-facebook"></i></a></li>

		<li><a href="https://www.linkedin.com/company-beta/2380281/" class="tooltip1" title="Linkedin" target="_blank"><i class="icon-linkedin"></i></a></li>

		<li><a href="https://www.youtube.com/user/BencardinoExcavating" class="tooltip1" title="Youtube" target="_blank"><i class="icon-youtube"></i></a></li>

		<li><a href="https://www.google.com/search?q=Bencardino+Excavating+Inc&ei=CL_FXY-UM47l5gKqqoTwCQ&start=0&sa=N&ved=0ahUKEwiPuNLxqdvlAhWOslkKHSoVAZ44RhDy0wMIcw&biw=1920&bih=937" class="tooltip1" title="Google+" target="_blank"><i class="icon-google-plus"></i></a></li>

		<li><a href="https://www.flickr.com/photos/louisbencardino/" class="tooltip1" title="Flickr" target="_blank"><i class="icon-flickr"></i></a></li>

		<li><a href="https://www.instagram.com/bencardinoexcavating/" class="tooltip1" title="Instagram" target="_blank"><i class="icon-instagram"></i></a></li>



	</ul>

</div>

</section>

</section>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-8276906-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-8276906-1');
</script>
