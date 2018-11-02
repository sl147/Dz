<template>	
	<div class="page-container md-layout-column">
		<md-drawer :md-active.sync="showNavigation" >
			<md-toolbar class="md-transparent" md-elevation="0">
				<span class="md-title">toolbar</span>
			</md-toolbar>
			<div class="text-center" v-show="loaderTask===true">
				<img src="../image/loader.gif" alt="">
			</div>
			<div v-show="loaderTask===false" class="toolbarwidth">
				<md-field :class="messageClass">
					<label>Введите текст новой задачи</label>
					<md-textarea v-model="newTask" required autofocus></md-textarea>
					<span class="md-helper-text">Символ !(восклицательный знак) не принимаеться</span>
					<span class="md-error">There is an error</span>
				</md-field>
				<div class="text-center">
					<div>
						<md-button class="md-raised md-primary" @click="addItem()" :disabled="disable">Добавить задачу</md-button>
					</div>								
				</div>
				<div class="warningTXT text-center" v-show="showSnackbar">
					<template>
						<md-snackbar :md-position="position" :md-duration="duration" :md-active.sync="showSnackbar" md-persistent>
							<span>{{errTXT}}</span>
							<md-button class="md-primary" @click="showSnackbar = false">Повторите</md-button>
						</md-snackbar>
					</template>									
				</div> 
			</div>
		</md-drawer>
	</div>
</template>