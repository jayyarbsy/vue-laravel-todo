<template>
	<div class="container-main">
		<section class="app-header">
			<div class="title-wrap">
				<h1>To-Do<br>List App</h1>
			  <p>(Version {{ version }} - Laravel/Vue)</p>
			  <p id="date">{{ getDate }}</p>
			</div>
			<NewTask/>
	  </section>
		<TaskList/>
		<Save :lastSave="lastSave">
			<p class="save-status" slot="save-message">{{ saveStatus }}</p>
		</Save>
	</div>
</template>

<script>
import { EventBus } from '../bus.js';
import TaskList from './TaskList';
import NewTask from './NewTask';
import Save from './Save';
export default {
	name: 'App',
	data() {
		return {
			version: '1.3.0',
			saveStatus: '',
			currentTime: '',
			lastSave: ''
		}
	},
	computed: {
		getDate: function() {
			let date = new Date();
			let options = {
			  year: "numeric", month: "short", day: "numeric"
			};
			return date.toLocaleDateString("en-US", options);
		}
	},
	methods: {
		getTime: function() {
			let date = new Date();
			let options = {
				hour: "2-digit", minute: "2-digit", second: "2-digit"
			};
			return date.toLocaleDateString("en-US", options);
		},
		updateTime: function() {
			this.currentTime = this.getTime();
		}
	},
	created() {
		let vm = this;
		EventBus.$on('save-success', function() {
			let timeout;
			vm.saveStatus = 'Save successful!';
			// Update 'last save' timestamp
			vm.lastSave = vm.currentTime;
			// Save timestamp
			axios.post('todo/settime', [{ "time": vm.lastSave }]).then((res) => {
				console.log('Timestamp saved!', res);
			}).catch((err) => {
				console.log('There was an error', err);
			});
			clearTimeout(timeout);
			timeout = setTimeout(function() {
				vm.saveStatus = '';
			}, 3000);
		});
		EventBus.$on('save-failure', function() {
			let timeout;
			vm.saveStatus = 'Error! Save not successful';
			clearTimeout(timeout);
			timeout = setTimeout(function() {
				vm.saveStatus = '';
			}, 5000);
		});
		axios.get('todo/gettime').then((res) => {
			res.data.forEach(function(item) {
				vm.lastSave = item.time;
			});
		});
		// Start the clock ticking
		setInterval(vm.updateTime, 1000);
	},
	components: {
		TaskList,
		NewTask,
		Save
	}
}
</script>

<style scoped>
p {
	font-family: "Fira Sans", sans-serif;
}
.container-main {
	background-color: #efefef;
	border: 1px solid #ccc;
	margin: 20px auto;
	width: 80vw;
  height: auto;
}
.app-header {
	margin-bottom: 60px;
	padding-left: 20px;
}
#date {
	font-size: 24px;
	font-weight: bold;
}
.title-wrap {
	margin-bottom: 40px;
}
.title-wrap h1 {
	font-family: "Space Mono", monospace;
	font-size: 40px;
  line-height: 42px;
  margin-bottom: 0;
}
.save-status {
	display: inline;
	vertical-align: bottom;
	font-size: 21px;
	line-height: 32px;
	padding-left: 20px;
}
</style>