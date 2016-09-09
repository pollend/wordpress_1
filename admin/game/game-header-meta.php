<?php
class Game_Header_Meta_Box {

	public function __construct() {

		if ( is_admin() ) {
			add_action( 'load-post.php',     array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}

	}

	public function init_metabox() {

		add_action( 'add_meta_boxes', array( $this, 'add_metabox'  )        );
		add_action( 'save_post',      array( $this, 'save_metabox' ), 10, 2 );

		wp_enqueue_script('game-header-meta', get_template_directory_uri() .'/admin/game/GameHeaderMeta.js', array('jquery','media-upload','thickbox'),1,true);
		
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('my-upload');
		wp_enqueue_style('thickbox');
		
		wp_enqueue_script( 'vue',  get_template_directory_uri() ."/js/vue/vue.min.js",'1');


	}

	public function add_metabox() {

		add_meta_box(
			'game_images',
			__( 'Game Snapshots', 'text_domain' ),
			array( $this, 'render_metabox' ),
			'game',
			'advanced',
			'default'
		);

	}

	public function render_metabox( $post ) {

		// Add nonce for security and authentication.
		wp_nonce_field( 'game_nonce_action', 'game_nonce' );

		$game_images = get_post_meta( $post->ID, 'game_image', true );		
		var_dump($game_images);

		?>
		<script>
			 <?php if(isset($game_images)):?>
	        	var game_image_payload = <?php echo json_encode($game_images); ?>
	        <?php else: ?>
	        	var game_image_payload = [];
	        <?php endif; ?> 
		</script>

		<div id="game_snapshots">
			<table class="form-table">
				<tr v-for="game_image in games_images" >
					<td>
						<input type="text" name="game_image[{{ $index }}][image]" value="{{  game_image.image }}" class="game_image_field" >
						<button v-on:click="setImage($index,$event)">Upload Image</button>
						<button v-on:click="removeEntry($index,$event)">Delete</button>
					</td>
					<td>
						</br>
					</td>
				</tr>
				
			</table>
			<button v-on:click="addEntry($event)"> Add Entry</button>
		</div>




		<?php


	}

	public function save_metabox( $post_id, $post ) {

		// Add nonce for security and authentication.
		$nonce_name   = $_POST['game_nonce'];
		$nonce_action = 'game_nonce_action';

		// Check if a nonce is set.
		if ( ! isset( $nonce_name ) )
			return;

		// Check if a nonce is valid.
		if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
			return;

		// Check if the user has permissions to save data.
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return;

		// Check if it's not an autosave.
		if ( wp_is_post_autosave( $post_id ) )
			return;

		// Check if it's not a revision.
		if ( wp_is_post_revision( $post_id ) )
			return;


		// Sanitize user input.
		$game_image =  $_POST[ 'game_image' ];

		// Update the meta field in the database.
		update_post_meta( $post_id, 'game_image', $game_image );
	}

}

new Game_Header_Meta_Box;