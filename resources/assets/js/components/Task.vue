<template>
	<div class="container-component">
		<div class="task">
			<!-- Slot for checkbox or checkmark, depending on completed status -->
			<slot name="completed"></slot>
			<!-- Slot for read-only or writable textarea depending on completed status -->
			<slot name="textbox"></slot>
			<div class="remove-button" title="Remove task" @click="emitDelete">X</div>
		</div>
	</div>
</template>


<script>
export default {
	name: 'Task',
	props: ['taskId'],
	methods: {
		// Emit delete event to parent (EventBus not needed)
		emitDelete: function() {
			this.$emit('delete-task', this.taskId);
		}
	}
}
</script>

<style>
.hidden {
	display: none !important;
}
.task {
	position: relative;
	font-size: 20px;
	background-color: white;
	height: 45px;
	padding-left: 20px;
	margin-bottom: 5px;
	border-top: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
}
.tr-checkbox {
	display: inline-block;
    position: relative;
	width: 25px;
    height: 25px;
    border: 3px solid #ccc;
    margin-right: 15px;
    cursor: pointer;
}
.checkmark {
	display: inline-block;
	position: relative;
	width: 35px;
	height: 44px;
	margin-right: 11px;
    vertical-align: middle;
    top: -10px;
    left: -2px;
}
.task textarea {
	position: relative;
	font-family: "Fira Sans";
	font-size: 28px;
	resize: none;
	border: none;
	top: 50%;
	transform: translateY(-50%);
}
#completed-list .task textarea {
	color: #cacaca;
	text-decoration: line-through #000;
}
.task textarea:focus,
.task textarea:active {
	outline: none;
}
.remove-button {
	display: inline;
	position: absolute;
	color: #ff0000;
	font-size: 15px;
	font-weight: bold;
	right: 5vw;
	top: 50%;
	transform: translateY(-50%);
	border: 2px solid #000;
	border-radius: 20px;
	padding: 2px 9px;
	cursor: pointer;
	transition-property: color, background-color, border-color;
	transition-duration: 300ms;
	transition-timing-function: ease;
}
.remove-button:hover {
	color: #fff;
	background-color: #ff0000;
	border-color: #ff0000;
}

</style>