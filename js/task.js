Vue.use(VueMaterial.default);
let vueEl = new Vue({
	el: '#vueElement',
	data: {
		select : '../vue/selTasks.php',
		addTaskPost: '../vue/addTaskPost.php',
		editorPost: '../vue/edTaskPost.php',
		delPost: '../vue/delTaskPost.php',
		loader: true,
		loaderTask: false,
		newTask:'',
		disable: true,
		errMesage: false,
		errTXT: 'ошибка. символ ! запрещен для ввода.',
		tasks: [],
		visibleDelete: false,
		visibleEditor: false,
		taskEditor: '',
		taskId:'',
		showNavigation: false,
		hasMessages: false,

		showSnackbar: false,
		position: 'left',
		duration: 4000,

		activeDel: false,
		activeEd: false,
		taskDelete:'',
		amount: 0,
		progressBar: false,
		isTasks: 3,
		show: false
	},
	methods: {
		addTask: function() {
			this.showNavigation = true
			this.newTask = ''
			this.loaderTask = false	
		},
	    taskEmpty: function() {
				for (var task of this.tasks) {
					this.isTasks = 2
					return this.isTasks
				}
				this.isTasks = 1
	    },
		delItem: function(task) {
			this.taskDelete = task
			this.activeDel = true
		},
		onConfirm () {
			this.isTasks = 3
			this.progressBar = true			
			this.visibleDelete = false
			axios.post(this.delPost,{'id':this.taskDelete.id})
			.then(response => {
				this.tasks.splice(this.tasks.indexOf(this.taskDelete),1)
				setTimeout(()=>{					
					this.progressBar = false
					this.taskEmpty()					
				}, 500);
			})
			.catch(err => {
			console.log(err)
			})			
		},
		onCancel () {

		},
		onConfirmEd () {
			this.isTasks = 3
			this.progressBar = true
			axios.post(this.editorPost,{'newTask':this.taskEditor, 'id':this.taskId})
			.then(response => {
				setTimeout(()=>{
					this.progressBar = false
					this.getAllTasks()
					this.show = false
					this.taskEditor = ""
					this.isTasks = 2					
				}, 1000);									
			})
			.catch(err => {
    		console.log(err)
			})		
		},
		onCancelEd () {
			this.taskEditor = ""
		},
		modalEditor(task){
			this.activeEd = true
			this.visibleEditor = true
			this.taskEditor = task.task
			this.taskId = task.id
		},
		verifyErrors(txt) {
			return txt.includes("!")
		},
		edItem() {
			this.loaderTask = true
			if (this.verifyErrors(this.taskEditor)) {
				this.errMesage = this.verifyErrors(this.taskEditor)
				this.showSnackbar = true
			}
			
			if (!this.errMesage) {
				axios.post(this.editorPost,{'newTask':this.taskEditor, 'id':this.taskId})
				.then(response => {
						this.getAllTasks()
						this.show = false
						this.taskEditor = ""						
				})
				.catch(err => {
	    		console.log(err)
				})
				this.loaderTask = false
			}
			else {
				this.errMesage = true
			}
			this.loaderTask = false
			this.visibleEditor = false
		},
		addItem() {
			this.loaderTask = true			
			if (this.verifyErrors(this.newTask)) {
				this.errMesage = this.verifyErrors(this.newTask)
				this.showSnackbar = true
			}			
			if (!this.errMesage) {
				axios.post(this.addTaskPost,{'newTask':this.newTask})
				.then(response => {
				setTimeout(()=>{					
					this.getAllTasks()
					this.show = false
					this.newTask = ""				
					this.showNavigation = false	
							
				}, 500);											
				})
				.catch(err => {
	    			console.log(err)
				})
			}
			else {
				setTimeout(()=>{
					this.errMesage = true
					this.loaderTask = false
				}, 500);
			}			
		},	
		getAllTasks() {
			axios.post(this.select)
			.then(response => {
				this.tasks = response.data
				for (var task of this.tasks) {
				}
				this.taskEmpty()
			})
			.catch(err => {
    		console.log(err)
			})
			this.loader = false
		}
	},
	watch: {
		newTask: function (val) {
			this.disable = (val.length > 0) ? false  : true
			this.errMesage = false
			if (val.length > 0) {
				if (this.verifyErrors(val)) {
					this.errMesage = this.verifyErrors(val)
					this.showSnackbar = true
				}
			}
		}
	},
	computed: {
		messageClass () {
	        return {
	          'md-invalid': this.hasMessages
	        }
	      },
	},
	created: function() {
		this.loader = true
				setTimeout(()=>{
					this.loader = false
					this.getAllTasks()					
				}, 500);
	}
})