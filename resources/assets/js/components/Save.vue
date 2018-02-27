<template>
	<div class="container-component">
		<section id="footer">
			<div class="save-wrap">
				<button id="save-button" @click.prevent="emitSave">{{ buttonText }}</button>
				<slot name="save-message"></slot>
			</div>
			<p><strong>Last save:</strong> {{ lastSave }}</p>
		</section>
	</div>
</template>

<script>
import { EventBus } from '../bus.js'
export default {
	name: 'Save',
	data() {
		return {
			buttonText: 'Save current list'
		}
	},
	methods: {
		// Publish save event via EventBus
		emitSave: function() {
			EventBus.$emit('save-state');
		}
	},
	props: ['lastSave']
}
</script>

<style scoped>
#footer {
	position: relative;
	bottom: 2px;
	left: 0;
	padding-left: 20px;
	padding-bottom: 20px;
}
#save-button {
	font-size: 21px;
  font-family: "Fira Sans", sans-serif;
  text-transform: uppercase;
  vertical-align: top;
}
</style>