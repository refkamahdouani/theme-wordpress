<?php

//prevent direct access
if ( ! defined( 'ABSPATH' ) ) exit;

class Senpai_Walker_Comment extends Walker_Comment {

//https://developer.wordpress.org/reference/classes/walker_comment/

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '';
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
                $output .= '';
    }

    public function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
            //error_log(print_r($comment,1));
            //comment_content
            //user_id
            $comment_content = $comment->comment_content;
            $comment_user =  $comment->user_id;
            $comment_id =$comment->comment_ID;
            $comment_author =$comment->comment_author;
            $comment_post_ID =$comment->comment_post_ID;
            //comment_date
            //2020-09-04 06:42:12
            $comment_date = $comment->comment_date;
            $format = "Y-m-d H:i:s";

            //https://www.php.net/manual/en/datetime.formats.php
            $dateobj = DateTime::createFromFormat($format, $comment_date);

            //https://www.php.net/manual/en/datetime.format.php
            $formattedDate = date_format($dateobj, 'g:i a\, l jS F Y');
            
            //error_log(print_r(date_format($dateobj, 'g:i a\, l jS F Y'),1));

            $avatar              = get_avatar_url( $comment, $args['avatar_size'] );
            $reply_comment = '';

            if($comment->comment_parent !== '0'){
                //$reply_comment = 'reply-comment';
            }

            //$output .= '<div class="start_el">';
            //$output .= '<h2>' . $comment_content . '</h2>';
            $comment_classes = 'media';
            //$comment_classes = comment_class($this->has_children ? 'parent media' : 'media', $comment,$comment_post_ID,false );
            $output .= "<div data-sr id='comment-${comment_id}' class='${reply_comment} ${comment_classes}' >";
            $output .= '<div class="pull-left">';
            $output .= "<img class='comment-img' src='${avatar}' alt='avatar'>";
            $output .= '</div>';
            $output .= '<div class="media-body">';
            $output .=            "<h6>${comment_author}";
            $output .=            "<span>${formattedDate}</span>";
            $output .=            '</h6>';
            $output .=            "<p>${comment_content}</p>";
            $output .=            '<div class="comment-meta">';
            if ( comments_open() ){
            $output .= "<a id='replay' href='#post-comment' data='${comment_id}'>Reply</a>";
            }
            $output .= '<a href="#">Share</a>';
            $output .= '</div></div></div>';

    }

    public function end_el( &$output, $comment, $depth = 0, $args = array() ) {
            $output .= "";
    }

}
