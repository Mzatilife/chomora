<?php
include_once "dbh.class.php";
class Project extends Dbh
{
    //-----------------------DEALS WITH THE project CATEGORY ---------------------------------------//
    protected function addsCategory($name)
    {
        $sql = "INSERT INTO project_categories ( `category_name`, `upload_date`) VALUES (?, NOW())";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$name]);
        return $result;
    }

    protected function viewsCategories()
    {
        $sql = "SELECT * FROM project_categories ORDER BY `category_id` DESC";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }

    protected function editsCategory($id, $name)
    {
        $sql = "UPDATE project_categories SET  `category_name` = ? WHERE `category_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$name, $id]);
        return $result;
    }

    protected function deletesCategory($id)
    {
        $sql = "DELETE FROM project_categories WHERE `category_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$id]);

        $sql2 = "DELETE FROM projects WHERE `category_id` = ?";
        $stmt2 = $this->connect()->prepare($sql2);
        $result2 = $stmt2->execute([$id]);

        if ($result && $result2) {
            return true;
        } else {
            return false;
        }
    }

    protected function countsCategory()
    {
        $sql = "SELECT * FROM `project_categories`";
        $stmt = $this->connect()->query($sql);
        return $stmt->rowCount();
    }


    //-----------------------DEALS WITH THE ACTUAL project CATEGORY ---------------------------------------//
    protected function addsproject($cat, $title, $author, $image, $content, $sdate, $edate)
    {
        $sql = "INSERT INTO projects ( `category_id`, `title`, `author`, `image`, `content`, `start_date`, `end_date`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$cat, $title, $author, $image, $content, $sdate, $edate]);
        return $result;
    }

    protected function editsproject($cat, $title, $author, $image, $content, $sdate, $edate, $project_id)
    {
        $sql = "UPDATE `projects` SET `category_id` = ?, `title` = ?, `author` = ?, `image` = ?, `content` = ?, `start_date` = ?, `end_date` = ? WHERE `project_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$cat, $title, $author, $image, $content, $sdate, $edate, $project_id]);
        return $result;
    }

    protected function viewsproject()
    {
        $sql = "SELECT * FROM `projects` INNER JOIN `project_categories` ON projects.category_id = project_categories.category_id ORDER BY projects.project_id DESC";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }

    protected function viewsprojectById($id)
    {
        $sql = "SELECT * FROM `projects` INNER JOIN `project_categories` ON projects.category_id = project_categories.category_id WHERE projects.project_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    protected function viewsprojectWithLimit($start, $end)
    {
        $sql = "SELECT * FROM `projects` INNER JOIN `project_categories` ON projects.category_id = project_categories.category_id ORDER BY projects.project_id DESC LIMIT $start, $end";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll();
    }
    protected function countsproject()
    {
        $sql = "SELECT * FROM `projects` INNER JOIN `project_categories` ON projects.category_id = project_categories.category_id";
        $stmt = $this->connect()->query($sql);
        return $stmt->rowCount();
    }

    protected function viewsprojectAndCategory($id, $start, $end)
    {
        $sql = "SELECT * FROM `projects` INNER JOIN `project_categories` ON projects.category_id = project_categories.category_id WHERE project_categories.category_id = ? ORDER BY projects.project_id DESC LIMIT $start, $end";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }
    protected function countsprojectAndCategory($id)
    {
        $sql = "SELECT * FROM `projects` INNER JOIN `project_categories` ON projects.category_id = project_categories.category_id WHERE project_categories.category_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    protected function deletesproject($id)
    { 
        $image = $this->viewsprojectById($id);
        unlink("../img/project/" . $image['image']);

        $sql = "DELETE FROM projects WHERE `project_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$id]);

        // $sql2 = "DELETE FROM comments WHERE `project_id` = ?";
        // $stmt2 = $this->connect()->prepare($sql2);
        // $result2 = $stmt2->execute([$id]);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    //-----------------------DEALS WITH THE COMMENTING SECTION ---------------------------------------//
    protected function commentsproject($project_id, $name, $email, $comment)
    {
        $sql = "INSERT INTO comments ( `project_id`, `name`, `email`, `comment`, `date`) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$project_id, $name, $email, $comment]);
        return $result;
    }

    protected function viewsComments($id, $start, $end)
    {
        $sql = "SELECT * FROM `comments` WHERE `project_id` = ? ORDER BY `comment_id` DESC LIMIT $start, $end";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function countsComments($id)
    {
        $sql = "SELECT * FROM `comments` WHERE `project_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    protected function deletesComment($id)
    {
        $sql = "DELETE FROM comments WHERE `comment_id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $result = $stmt->execute([$id]);
        return $result;
    }
}
