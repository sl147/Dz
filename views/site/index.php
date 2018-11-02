<?php include_once "views/layouts/header.php";?>
<?php include_once "views/layouts/footer.php";?>
<div id="vueElement">
	<div class="text-center" v-show="loader">
		<img src="../image/loader.gif" alt="">
	</div>

<div class="container-fluid">
	<div class="row">
		<div class="text-center col-lg-2 col-md-2 col-sm0 col-xs-0"></div>
		<div class="text-center col-lg-7 col-md-7 col-sm-12 col-xs-12">
			<div class="row">
				<div class="text-center col-lg-3 col-md-3 col-sm0 col-xs-0"></div>
				<div class="text-center col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<template v-if="progressBar">
						<div style="margin-top: 100px; ">
							<md-progress-bar md-mode="indeterminate"></md-progress-bar>
							<md-progress-bar class="md-accent" md-mode="indeterminate"></md-progress-bar>
						</div>
					</template>	
				</div>
			</div>
			<template v-if="isTasks===2">
				<!-- 			<transition name="fade" mode="out-in"> -->		
					<?php include_once "views/site/isTask.php";?>
				</template>
				<template v-else-if="isTasks===1" >
					<?php include_once "views/site/noTask.php";?>						
				</template> 
			</div>
		</div>				
	</div>	
	<?php include_once "views/site/toolBar.php";?>
</div>
<script src="../js/task.js"></script>