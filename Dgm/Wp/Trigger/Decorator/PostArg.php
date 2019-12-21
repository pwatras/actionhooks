<?php
/*
 * add post meta-data whenever post (WP_Post object) is present in arguments
 */
namespace Dgm\Wp\Trigger\Decorator;

class PostArg implements IInputDecorator {
    public function decorate(array $args): array {
        foreach($args as $key=>$val) {
            if($val instanceof \WP_Post) {
                $args[$key] = $this->getPostDetails($val);
            }
        }
        return $args;
    }
    
    protected function getPostDetails(\WP_Post $post) {
        return [
            'post'=>$post,
            'metadata'=> get_post_meta($post)
        ];
    }
}
