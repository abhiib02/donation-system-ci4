
    <div class="container fullvh center">
        <div>
        <div class="center">
        <img width="15%" src="<?=env('app.baseURL')?>assets/svg/donate.svg" alt="">            
        </div>
        <h1 class="text-center text-theme">Thank You for Your Donation!</h1>
        <hr>
        Dear <b><?=$DonaterData['name']?></b>,
        <br><br>
        On behalf of <?=env('appName')?>, we extend our deepest gratitude for your generous donation. Your support plays a pivotal role in advancing our mission to foster positive change in rural areas through education, comprehensive training, and holistic well-being.
        <br><br>
        Your commitment to making a difference is truly inspiring. With your contribution, we can continue empowering individuals in underserved communities, providing them with access to quality education, sustainable development initiatives, and opportunities for growth.
        <br><br>
        At <?=env('appName')?>, we believe in creating lasting impacts, and your donation is a crucial step towards building a brighter and more sustainable future for those in need. We assure you that every penny will be utilized efficiently to maximize its positive influence on the lives of individuals and communities we serve.
        <br><br>
        Once again, thank you for your generosity and belief in our cause. We look forward to keeping you updated on the progress of our projects and the impact of your valuable contribution.
        <br><br>
        Warm regards,<br>
        <?=env('appName')?><br>
        <?=env('ngoOwner')?>
        <br><br>
        <p>We would be grateful if you could please check your email <b><?=$DonaterData['email']?></b> for the donation certificate. <br>
        It may have been sent to your spam folder.</p>
        <hr>
        <div class="center">
            <div>
        <a class="btn btn-theme" href="/">Back To Home</a>
        <a class="btn btn-secondary" href="https://mail.google.com/mail/u/0/">Check Email</a>
        </div>
        </div>
        
        </div>
    </div>
