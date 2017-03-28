new Vue({
	el: '#app',
	
	data: {
		frames: [],
		total_images: 0,
		images_loaded: 0,
		current_frame: 0
	},
	
	methods: {
		frameLoaded: function(e) {
			this.images_loaded++;
		}
	},
	
	created: function() {
		this.$http.get('/api/list').then(responce => {
			var i = 0;
			for (var frame of responce.body) {
				this.frames.push({
					no: i,
					url: '/upload/screenshots/' + frame.filename
				});
				i++;
			}
			this.total_images = this.frames.length;
		}, console.error);
	}
	
});

