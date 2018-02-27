require('./bootstrap');

// Pub/sub event bus for components that aren't parent-child
export const EventBus = new Vue();