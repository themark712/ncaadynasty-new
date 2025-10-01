<?php
$hero_title = "Home";
$hero_text = "Welcome";

require "_include/header.php";
?>

<!-- Featured Services Section -->
<section class="pagetitle">

    <h3 class="pageheader">Welcome to NCAA Football 25 Dynasty Manager</h3>

    <div class="row gy-4 gx-2">
        <!-- Card with an image on top -->
        <div class="card col-4">
            <img src="_assets/img/card-1.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Manage your dynasty</h5>
                <p class="card-text">Show off your dynasty to the world.</p>
            </div>
        </div><!-- End Card with an image on top -->


        <!-- Card with an image on top -->
        <div class="card col-4">
            <img src="_assets/img/card-2.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card with an image on top</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div><!-- End Card with an image on top -->


        <!-- Card with an image on top -->
        <div class="card col-4">
            <img src="_assets/img/hero_bg_4.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card with an image on top</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div><!-- End Card with an image on top -->


    </div>


    <div class="row gy-4">

        <div class="col-lg-6 position-relative align-self-start order-lg-last order-first" data-aos="fade-up" data-aos-delay="200">
            <img src="<?= $filepath ?>_assets/img/about.jpg" class="img-fluid" alt="">
        </div>

        <div class="col-lg-6 content order-last  order-lg-first" data-aos="fade-up" data-aos-delay="100">
            <h3>About Us</h3>
            <p>
                Dolor iure expedita id fuga asperiores qui sunt consequatur minima. Quidem voluptas deleniti. Sit quia molestiae quia quas qui magnam itaque veritatis dolores. Corrupti totam ut eius incidunt reiciendis veritatis asperiores placeat.
            </p>
            <ul>
                <li>
                    <i class="bi bi-diagram-3"></i>
                    <div>
                        <h5>Ullamco laboris nisi ut aliquip consequat</h5>
                        <p>Magni facilis facilis repellendus cum excepturi quaerat praesentium libre trade</p>
                    </div>
                </li>
                <li>
                    <i class="bi bi-fullscreen-exit"></i>
                    <div>
                        <h5>Magnam soluta odio exercitationem reprehenderi</h5>
                        <p>Quo totam dolorum at pariatur aut distinctio dolorum laudantium illo direna pasata redi</p>
                    </div>
                </li>
                <li>
                    <i class="bi bi-broadcast"></i>
                    <div>
                        <h5>Voluptatem et qui exercitationem</h5>
                        <p>Et velit et eos maiores est tempora et quos dolorem autem tempora incidunt maxime veniam</p>
                    </div>
                </li>
            </ul>
        </div>

    </div>

</section>

<?php
require "_include/footer.php";
?>