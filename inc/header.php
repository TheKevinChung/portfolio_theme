<header>
	<div class="head-bar">
		<p class="logo"><a href="/"><?=$site_logo?></a></p>
		<div class="menu-btn">
			<p class="menu-inner">
				<span></span>
			</p>
		</div>
	</div>
	<nav>
		<ul>
			<li <?=strpos($_SERVER['PHP_SELF'], "About") ? 'class="active"' : ''?>><a href="/About">About</a></li>
		<? for($i=0; $i<count($site_snsDName); $i++) { 
			
			if($site_snsDName[$i] == "")
				continue;
		?>
			<li><a href="<?=$site_snsDUrl[$i] ?? '#none'?>" target="_blank"><?=$site_snsDName[$i]?></a></li>
		<? } ?>
		</ul>
	</nav>
</header>