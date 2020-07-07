var player = videojs("video");

// For video views
var viewLogged = false;

player.on("timeupdate", function() {
    var percentagePlayed = Math.ceil(
        (player.currentTime() / player.duration()) * 100
    );

    if (percentagePlayed > 5 && !viewLogged) {
        axios.put("/videos/" + window.CURRENT_VIDEO);

        // console.log(percentagePlayed);
        viewLogged = true;
    }
});
