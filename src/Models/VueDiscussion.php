<?php

namespace DevDojo\Chatter\Models;

use Illuminate\Database\Eloquent\Model;
use GrahamCampbell\Markdown\Facades\Markdown;
use DevDojo\Chatter\Models\Discussion;

class VueDiscussion extends Model
{
    protected $fillable = [
        'excerpt', 'discussion'
    ];

    public function __construct( Discussion $discussion ){
        $this->discussion   = $discussion;

        if( $discussion->post[0]->markdown ){
            $body = Markdown::convertToHtml( $discussion->post[0]->body );
        } else {
            $body = $discussion->post[0]->body;
        }

        $excerpt = substr( strip_tags( $body ), 0, 200 );
        if( strlen( strip_tags( $body ) ) > 200 ){
            $excerpt .= " ...";
        }

        $this->excerpt = $excerpt;
    }
}
