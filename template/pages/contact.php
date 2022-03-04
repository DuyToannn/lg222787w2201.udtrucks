<section id="stores">
        <div class="container">
            <div class="store-wrapper">
                <h1 class="page-heading"><?=$this->item->title?></h1>
                <h2><?=$this->setting->name?></h2>
                <p>Hotline: <a href="tel:<?=$this->setting->hotline?>"><?=$this->setting->hotline?></a> - Email: <?=$this->setting->email?></p>
				<p><?=$this->setting->address?></p>
                <div class="store-img">
                    <img src="/template/images/store.jpeg" alt="">
                </div>
            </div>
        </div>
</section>