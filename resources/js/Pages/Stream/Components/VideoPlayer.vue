<template>
    <div>
        <h2 class="text-4xl font-bold text-center text-gray-700 mb-16 my-8">DEMO</h2>
        <div class="flex flex-wrap justify-center">
            <div class="w-full xl:w-2/3 xl:px-3 mb-16 xl:mb-0">
                <video ref="videoPlayer" class="video-js" tabindex="1">
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>
                </video>
            </div>
        </div>
    </div>
</template>

<script>
import videojs from 'video.js';

export default {
    name: "VideoPlayer",
    props: {
        id: {
            required: true
        },
    },

    data(){
        return {
            player: null,
            options: {
                fluid: true,
                autoplay: true,
                controls: true,
                sources: [
                    {
                        src: `http://kino-memes.live/hls/${this.id}.m3u8`,
                        type: "application/x-mpegURL"
                    },
                ]
            }
        }
    },

    mounted(){
        this.player = videojs(this.$refs.videoPlayer, this.options, function onPlayerReady(){
            //
        });
    },

    beforeUnmount(){
        if(this.player){
            this.player.dispose();
        }
    }
}
</script>

<style src="video.js/dist/video-js.css"></style>