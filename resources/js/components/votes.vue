<template>
  <div>
    <svg
      @click="vote('up')"
      class="like"
      :class="{ 'like-active': upvoted }"
      xmlns="http://www.w3.org/2000/svg"
      xmlns:xlink="http://www.w3.org/1999/xlink"
      aria-hidden="true"
      focusable="false"
      width="1em"
      height="1em"
      style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
      preserveAspectRatio="xMidYMid meet"
      viewBox="0 0 36 36"
    >
      <g>
        <path
          d="M18 32.43a1 1 0 0 1-.61-.21C11.83 27.9 8 24.18 5.32 20.51C1.9 15.82 1.12 11.49 3 7.64c1.34-2.75 5.19-5 9.69-3.69A9.87 9.87 0 0 1 18 7.72a9.87 9.87 0 0 1 5.31-3.77c4.49-1.29 8.35.94 9.69 3.69c1.88 3.85 1.1 8.18-2.32 12.87c-2.68 3.67-6.51 7.39-12.07 11.71a1 1 0 0 1-.61.21zM10.13 5.58A5.9 5.9 0 0 0 4.8 8.51c-1.55 3.18-.85 6.72 2.14 10.81A57.13 57.13 0 0 0 18 30.16a57.13 57.13 0 0 0 11.06-10.83c3-4.1 3.69-7.64 2.14-10.81c-1-2-4-3.59-7.34-2.65a8 8 0 0 0-4.94 4.2a1 1 0 0 1-1.85 0a7.93 7.93 0 0 0-4.94-4.2a7.31 7.31 0 0 0-2-.29z"
          class="clr-i-outline clr-i-outline-path-1"
          fill="#626262"
        />
      </g>
    </svg>
    {{ upvotes_count }}
    <svg
      @click="vote('down')"
      class="dislike"
      :class="{ 'dislike-active': downvoted} "
      xmlns="http://www.w3.org/2000/svg"
      xmlns:xlink="http://www.w3.org/1999/xlink"
      aria-hidden="true"
      focusable="false"
      width="1em"
      height="1em"
      style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
      preserveAspectRatio="xMidYMid meet"
      viewBox="0 0 36 36"
    >
      <g>
        <path
          d="M33 7.64c-1.34-2.75-5.09-5-9.69-3.69a9.87 9.87 0 0 0-6 4.84a18.9 18.9 0 0 0-2.23 5.33l5.28 2.34l-4.6 4.37l3.49 4.1l1.52-1.3L18.54 21l5.4-5.13L17.58 13a16.23 16.23 0 0 1 2.17-4.1a7.68 7.68 0 0 1 4.11-3c3.34-.89 6.34.6 7.34 2.65c1.55 3.18.85 6.72-2.14 10.81A57.16 57.16 0 0 1 18 30.16A57.16 57.16 0 0 1 6.94 19.33c-3-4.1-3.69-7.64-2.14-10.81a5.9 5.9 0 0 1 5.33-2.93a7.31 7.31 0 0 1 2 .29a7.7 7.7 0 0 1 3.38 2l.15-.3a10.66 10.66 0 0 1 1-1.41a9.64 9.64 0 0 0-3.94-2.22C8.2 2.66 4.34 4.89 3 7.64c-1.88 3.85-1.1 8.18 2.32 12.87C8 24.18 11.83 27.9 17.39 32.22a1 1 0 0 0 1.23 0c5.55-4.31 9.39-8 12.07-11.71c3.41-4.69 4.19-9.02 2.31-12.87z"
          class="clr-i-outline clr-i-outline-path-1"
          fill="#626262"
        />
      </g>
    </svg>
    {{ downvotes_count }}
  </div>
</template>

<script>
import numeral from "numeral";

export default {
  props: {
    default_votes: {
      required: true,
      default: () => []
    },

    entity_owner: {
      required: true,
      default: () => {}
    }
  },

  data() {
    return {
      votes: this.default_votes
    };
  },

  computed: {
    upvotes() {
      return this.votes.filter(v => v.type === "up");
    },
    downvotes() {
      return this.votes.filter(v => v.type === "down");
    },
    upvotes_count() {
      return numeral(this.upvotes.length).format("0a");
    },
    downvotes_count() {
      return numeral(this.downvotes.length).format("0a");
    },

    upvoted() {
      if (!__auth()) return false;
      return !!this.upvotes.find(v => v.user_id === __auth().id);
    },
    downvoted() {
      if (!__auth()) return false;
      return !!this.downvotes.find(v => v.user_id === __auth().id);
    }
  },

  methods: {
    vote(type) {
      if (__auth() && __auth().id === this.entity_owner) {
        return alert("We guess! This is your own video");
      }

      if (type === "up" && this.upvoted) return;

      if (type === "down" && this.downvoted) return;
    }
  }
};
</script>
