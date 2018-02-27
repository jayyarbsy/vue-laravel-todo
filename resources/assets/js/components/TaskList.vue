<template>
	<div class="container-component">
		<section class="app-main">
			<div id="task-list">
				<!-- Incomplete tasks go here -->
				<Task v-for="(task, index) in tasks" :key="task.id" :taskId="index" v-on:delete-task="deleteTask">
					<div class="tr-checkbox" title="Complete task" @click="completeTask(index)" slot="completed"></div>
					<textarea :id="'task-' + index" rows="1" cols="50" placeholder="Insert task name here..." spellcheck="false" slot="textbox" @keypress.enter.prevent v-model="tasks[index].text">{{ tasks[index].text }}</textarea>
				</Task>
			</div>
			<div id="completed-list">
				<!-- Completed tasks go here -->
				<Task v-for="(task, index) in completedTasks" :key="task.id" :taskId="index" v-on:delete-task="deleteCompleted">
					<img class="checkmark" src="/imgs/checkmark.jpg" slot="completed"/>
					<textarea :id="'task-' + index" rows="1" cols="50" placeholder="Insert task name here..." spellcheck="false" readonly="readonly" slot="textbox" v-model="completedTasks[index].text">{{ completedTasks[index].text }}</textarea>
				</Task>
			</div>
		</section>
	</div>
</template>

<script>
import { EventBus } from '../bus.js';
import Task from './Task';
export default {
	name: 'TaskList',
	data() {
		return {
			// Arrays of task objects populated by json read
			tasks: [],
			completedTasks: []
		}
	},
	methods: {
		deleteTask: function(info) {
			this.tasks.splice(info, 1);
		},
		deleteCompleted: function(info) {
			this.completedTasks.splice(info, 1);
		},
		completeTask: function(info) {
			this.tasks[info].completed = 'true';
			this.completedTasks.push(this.tasks[info]);
			this.tasks.splice(info, 1);
		}
	},
	components: {
		Task
	},
	created() {
		// Subscribe to task creation and new task text via EventBus
		let vm = this;
		EventBus.$on('task-created', function(info) {
			if (info === '') {
				info = 'New empty task';
			}
			vm.tasks.push({ 'text': info, 'completed': 'false' });
		});
		// Subscribe to list save via EventBus, write to database
		EventBus.$on('save-state', function() {
			axios.post('todo/save', [...vm.tasks, ...vm.completedTasks]).then((res) => {
				EventBus.$emit('save-success');
				console.log('List saved!', res);
			}).catch((err) => {
				EventBus.$emit('save-failure');
				console.log('There was an error', err);
			});
		});
	},
	mounted() {
		// Build initial task list from json database
		axios.get('todo/tasks').then((res) => {
			let vm = this;
			res.data.forEach(function(item) {
				if (item.completed === "false") {
					vm.tasks.push(item);
				} else {
					vm.completedTasks.push(item);
				}
			});
		}).catch((err) => {
			console.log(err);
		});
	}
}
</script>

<style scoped>
.app-main {
	margin-bottom: 60px;
}
#completed-list {
	margin-top: 30px;
	padding-top: 30px;
	border-top: 1px solid #ccc;
}
</style>