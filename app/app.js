var config = {
	api_host: 'http://cam.figli-migli.net',
	api_host: '',
};

new Vue({
	el: '#app',
	
	data: {
		frames: [],
		total_images: 0,
		images_loaded: 0,
		current_frame: 0,
		is_playing: false,
		play_speed: 200, // delay between frames switching
	},
	
	methods: {
		frameLoaded: function(e) {
			this.images_loaded++;
		},
		
		play: function(force) {
			if (force) {
				this.is_playing = true;
			}
			
			this.next_frame(1);
			
			if (this.is_playing) {
				setTimeout(this.play, this.play_speed);
			}
		},
		
		stop: function() {
			this.is_playing = false;
		},
		
		next_frame: function(delta) {
			var new_val = parseInt(this.current_frame) + delta;
			if (new_val > 0 && new_val < this.total_images) {
				this.current_frame = new_val;
			}
		}
	},
	
	created: function() {
		//return true;
		this.$http.get(config.api_host + '/api/list').then(responce => {
			var i = 0;
			for (var frame of responce.body) {
				this.frames.push({
					no: i,
					url: config.api_host + '/upload/screenshots/' + frame.filename,
					timestamp: frame.timestamp
				});
				i++;
			}
			this.total_images = this.frames.length;
		}, console.error);
	}
	
});

