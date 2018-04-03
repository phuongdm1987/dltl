<?php
	$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);

   if ($paginator->getTotal() > $paginator->getPerPage()):
?>
<ul class="pagination pull-right">
	<?php echo $presenter->render(); ?>
</ul>
<?php endif; ?>