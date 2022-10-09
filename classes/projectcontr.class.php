<?php
include_once "project.class.php";
class ProjectContr extends Project
{
    //-----------------------DEALS WITH THE project CATEGORY ---------------------------------------//
    public function addCategory($name)
    {
        return $this->addsCategory($name);
    }

    public function viewCategories()
    {
        return $this->viewsCategories();
    }

    public function countCategory()
    {
        return $this->countsCategory();
    }

    public function deleteCategory($id)
    {
        return $this->deletesCategory($id);
    }

    public function editCategory($id, $name)
    {
        return $this->editsCategory($id, $name);
    }

    //-----------------------DEALS WITH THE ACTUAL project CATEGORY ---------------------------------------//
    public function addproject($cat, $title, $author, $image, $content, $sdate, $edate)
    {
        return $this->addsproject($cat, $title, $author, $image, $content, $sdate, $edate);
    }

    public function editproject($cat, $title, $author, $image, $content, $sdate, $edate, $cat_id)
    {
        return $this->editsproject($cat, $title, $author, $image, $content, $sdate, $edate, $cat_id);
    }

    public function viewproject()
    {
        return $this->viewsproject();
    }

    public function viewprojectWithLimit($start, $end)
    {
        return $this->viewsprojectWithLimit($start, $end);
    }

    public function viewprojectById($id)
    {
        return $this->viewsprojectById($id);
    }

    public function countproject()
    {
        return $this->countsproject();
    }

    public function viewprojectAndCategory($id, $start, $end)
    {
        return $this->viewsprojectAndCategory($id, $start, $end);
    }

    public function countprojectAndCategory($id)
    {
        return $this->countsprojectAndCategory($id);
    }

    public function deleteproject($id)
    {
        return $this->deletesproject($id);
    }

    // ------------------------- THIS PART DEALS WITH THE COMMENTING PROCESS -------------------------
    public function commentproject($project_id, $name, $email, $comment)
    {
        return $this->commentsproject($project_id, $name, $email, $comment);
    }

    public function viewComments($project_id, $start, $end)
    {
        return $this->viewsComments($project_id, $start, $end);
    }
    public function countComments($project_id)
    {
        return $this->countsComments($project_id);
    }

    public function deleteComment($id)
    {
        return $this->deletesComment($id);
    }
}
