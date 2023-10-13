<nav aria-label="breadcrumb">

    <ul class="breadcrumb elm">

        <li class="breadcrumb-item"><a href="<?= Link::make('/')?>">ΑΡΧΙΚΗ</a></li>

        <?php if(isset($breadcrumb) && isset($breadcrumb->links)): ?>

            <?php for ($i=0; $i<count($breadcrumb->links);$i++): ?>

                <li class="breadcrumb-item <?= ($i==(count($breadcrumb)-1)) ? 'active' : '' ?>"><a href="<?=Link::make($breadcrumb->links[$i])?>"><?=$breadcrumb->titles[$i]?></a></li>

            <?php endfor; ?>

        <?php endif; ?>

    </ul>

</nav>