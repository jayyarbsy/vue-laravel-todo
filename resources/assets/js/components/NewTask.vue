<template>
	<div class="container-component">
		<div class="new-task-wrap">
			<textarea class="new-field" rows="1" cols="50" spellcheck="false" placeholder="Insert new task text here" v-on:keydown.enter.prevent="emitNew" v-model="newTaskText"></textarea>
			<a class="tr-button" href="#" title="Create new task" @click="emitNew">{{ buttonText }}</a>
		</div>
	</div>
</template>

<script>
import { EventBus } from '../bus.js'
export default {
	name: 'NewTask',
	data() {
		return {
			newTaskText: '',
			buttonText: 'Create new task'
		}
	},
	methods: {
		emitNew: function() {
			// Publish new task creation with task text via EventBus
			EventBus.$emit('task-created', this.newTaskText);
			this.newTaskText = '';
		}
	}
}
</script>

<style scoped>
.new-task-wrap {
	position: relative;
	margin-bottom: 60px;
}
.new-field {
	font-family: "Fira Sans";
  font-size: 28px;
  resize: none;
  border: none;
}
.new-field:focus,
.new-field:active {
	outline: none !important;
}
a.tr-button {
	display: block;
  color: #000;
  background-color: #fff;
  text-transform: uppercase;
  font-weight: bold;
  text-align: center;
  width: 150px;
  text-decoration: none;
  border: 3px solid #000;
  margin-top: 5px;
  padding: 10px 15px;
  transition-property: color, background-color;
  transition-duration: 300ms;
  transition-timing-function: ease;
}
a.tr-button:hover {
	color: #fff;
	background-color: #000;
}
</style>