

<header print>
    <div class="d-flex justify-content-between">
        <div>
        <img src="<?=env('appLogoPath')?>" width="30" height="24" alt="">
        </div>
        <h2><?=env('appName')?></h2>
    </div>
</header>
<hr print>
 <div class="container printable fullvh ">
    <div>
        <h3>Donation Acknowledgement</h3>
        <br>
    <section>
        <p>Dear <b><?=$name?></b>,</p>

        <p>We extend our heartfelt gratitude for your generous donation to <?=env('appName')?>.  Your support plays a pivotal role in advancing our mission to foster positive change in rural areas through education, comprehensive training, and holistic well-being.</p>

        <p> Your commitment to making a difference is truly inspiring. With your contribution, we can continue empowering individuals in underserved communities, providing them with access to quality education, sustainable development initiatives, and opportunities for growth.</p>
        
        <p>Once again, thank you for your generosity and belief in our cause. We look forward to keeping you updated on the progress of our projects and the impact of your valuable contribution.</p>

        <p>Here are the details of your donation:</p>

        <ul>
            <li><strong>Donor Name:</strong> <?=$name?></li>
            <li><strong>Donor Mail:</strong> <?=$email?></li>
            <li><strong>Amount:</strong>  ₹<?=$amount?></li>
            <li><strong>Payment ID:</strong> <?=$payment_id?></li>
            <?php $date=date_create($created_at);?>
            <li><strong>Date of Donation:</strong> <?php echo date_format($date,"d/M/Y");?></li>
            
        </ul>

        <p>Your generosity is deeply appreciated</p>

        <p>Once again, thank you for your support. We look forward to keeping you updated on the impact of your contribution.</p>

        <p>Sincerely,</p>

        <b><ul class="list-unstyled">
            <li><?=env('ngoOwner')?></li>
            <li><?=env('ownerPosition')?>, <?=env('appName')?></li>
            
        </ul></b>
    </section>
    <hr print>
    <footer print>
    <div class="d-flex justify-content-between">
        
        <p><i>* This is A computer generated acknowledgement no Signature Required</i></p>
        
        <p><i>Printed on <?php echo date("d/m/Y h:i:s")?></i></p>
    </div>
</footer>
<hr print>
    <button  no-print class="btn btn-dark" onclick="printDoc()">Print</button>
    <a href="/" no-print class="btn btn-secondary" >Back to Home</a>
</div>
</div>
<script>
    function printDoc(){
        document.querySelector('.printable').classList.remove('container');
        window.print();
    }
</script>