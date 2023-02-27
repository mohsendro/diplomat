<?php
namespace App\Controllers;

use App\Models\Post;
use App\Models\Advertising;
use App\Models\Project;
use App\Models\Consultant;
use TypeRocket\Controllers\Controller;

class FronPageController extends Controller
{
    /**
     * The index page for public
     *
     * @return mixed
     */
    public function index(Post $post, Advertising $advertising, Project $project, Consultant $consultant)
    {
        $posts        = $post->findAll()->where('post_status', '=', 'publish')->orderBy('id', 'DESC')->take(10)->get();
        $advertisings = $advertising->findAll()->where('post_status', '=', 'publish')->orderBy('id', 'DESC')->take(10)->get();
        $projects     = $project->findAll()->where('post_status', '=', 'publish')->orderBy('id', 'DESC')->take(10)->get();
        $consultants  = $consultant->findAll()->where('post_status', '=', 'publish')->orderBy('id', 'DESC')->take(10)->get();
        
        return tr_view('public.front-page', compact('posts', 'advertisings', 'projects', 'consultants') );
    }

    /**
     * The add page for public
     *
     * @return mixed
     */
    public function add()
    {
        // TODO: Implement add() method.
    }

    /**
     * Create item
     *
     * AJAX requests and normal requests can be made to this action
     *
     * @return mixed
     */
    public function create()
    {
        // TODO: Implement create() method.
    }

    /**
     * The edit page for public
     *
     * @param string|FronPage $fron_page
     *
     * @return mixed
     */
    public function edit(FronPage $fron_page)
    {
        // TODO: Implement edit() method.
    }

    /**
     * Update item
     *
     * AJAX requests and normal requests can be made to this action
     *
     * @param string|FronPage $fron_page
     *
     * @return mixed
     */
    public function update(FronPage $fron_page)
    {
        // TODO: Implement update() method.
    }

    /**
     * The show page for public
     *
     * @param string|FronPage $fron_page
     *
     * @return mixed
     */
    public function show(FronPage $fron_page)
    {
        // TODO: Implement show() method.
    }

    /**
     * The delete page for public
     *
     * @param string|FronPage $fron_page
     *
     * @return mixed
     */
    public function delete(FronPage $fron_page)
    {
        // TODO: Implement delete() method.
    }

    /**
     * Destroy item
     *
     * AJAX requests and normal requests can be made to this action
     *
     * @param string|FronPage $fron_page
     *
     * @return mixed
     */
    public function destroy(FronPage $fron_page)
    {
        // TODO: Implement destroy() method.
    }
}