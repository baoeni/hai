
	$(document).ready(function(){
		
		$('.rating-wrapper .rating-star').mouseenter(function(){
			var $this = $(this);
			changeRating($this)
		}).click(function(){
			
			var $this = $(this);
			var $wrapper = $this.closest('.rating-wrapper');
			//for ios
			changeRating($this);
			
			$wrapper.append('<p>sending...</p>');
			
			$.ajax({
			  url: $this.get(0).href,
			  success: function(data) {
			    if(data == 'success'){
					$wrapper.fadeOut(1000,function(){
						$wrapper.html('Thanks for your rating').fadeIn('slow',function(){
							//console.info($wrapper,$wrapper.get(0).parentNode);
							setTimeout(function(){$wrapper.fadeOut(1000);},2000);
						});
					});
				}
			  }
			});
			return false;
		})
		
		function changeRating($this){
			$this.prevAll().andSelf().addClass('rated');
			$this.nextAll().removeClass('rated');
			var $wrapper = $this.closest('.rating-wrapper');
			$('.rating-word',$wrapper).hide();
			$('.rating-word',$wrapper).eq($('.rating-star',$wrapper).index($this)).show();
		}
		
		$('.rating-wrapper .rating-close').click(function(){
			$wrapper = $(this).closest('.rating-wrapper');
			$wrapper.fadeOut();
			return false;
		})
	})
