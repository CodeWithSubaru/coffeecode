<?php
class Pdf extends TCPDF {
    
    public function Header() {
        $image_file = K_PATH_IMAGES.'logo.jpg';
        return $this->Ln(15) . $this->SetFont('dejavusans', 'B', 18) . "
        " . $this->Image($image_file, 10, 10, 85, 25, 'JPG', false, 300);
    }

    function Main() {
        $posts = new Post;
        $post = $posts->getPostByPostId(Input::get('post_id'));

        $title = $posts->data()->post_title;
        $content = $posts->data()->post_content;
        $html = "
        
        <div>
                " . $this->Ln(20) ."
                " . $this->SetFont('dejavusans', 'B', 18) ."
                " . $this->Cell(0, 0, $title, 0, 0, 'C') ."
                " . $this->Ln(20). "
                " . $this->SetFont('dejavusans', '', 14) . "
                <span> " . $content . " </span>
            <div>";
        return $html;
    }
    
    public function pdfFileName() {
        $post_id = Input::get('post_id');
        $posts = new Post();
        $posts->getId($post_id);

        return $posts->data()->post_title . "_" . Date::currentTimeAndDate() . '.pdf';
    }


}