window.Vue = require("vue");

require("./bootstrap");

window.Vue = require("vue");

Vue.config.ignoredElements = ["video-js"];

Vue.component(
    "subscribe-button",
    require("./components/subscribe-button.vue").default
);
Vue.component("votes", require("./components/votes.vue").default);

require("./components/channel-uploads");

const app = new Vue({
    el: "#app"
});
