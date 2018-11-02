<?php
class Controller{

    var $type;
    var $type2;
    
    // 생성자 호출
    function __construct(){
        $this->type;
        $this->type2;
    }

    // 게시판
    public function boardList($type,$type2,$keyword,$cNo){
            
        // 검색쿼리
        $this->type = $type;   //분류
        $this->type2 = $type2; //강의명 & 강사명
        $keyword = $_GET['keyword']; //검색명 
        $cNo = $_GET['category_no']; //분류코드

        //쿼리
        $query = "SELECT *
        FROM `tb_review` r
        JOIN `tb_lecture` l
        ON r.`lecture_no` = l.`lecture_no`
        JOIN `tb_user` u
        ON r.`user_id` = u.`id`
        JOIN `tb_category` c
        ON r.`category_no` = c.`category_no`"; // 기본 리스트 쿼리


        $where = "WHERE c.category_no = '$type'
                    AND l.lecture_title LIKE '%$keyword%' order by r.board_no desc"; //강의명 검색쿼리 
        
        $where2 ="WHERE c.category_no = '$type'
        AND u.name LIKE '%$keyword%' order by r.board_no desc"; //강사명 쿼리

        
        
        if($type != '' ){
            if($type2 == 1){
                $sql =$query.$where;
                //echo "확인".$sql;
            }else{
                $sql = $query.$where2;
            }
        }else{
            // 분류코별로 쿼리
            if($cNo != ''){
                $sql = $query."where c.category_no = '$cNo' order by r.board_no desc";
            } else{
                $sql = $query."order by r.board_no desc";
            }
        }
        $result = mysql_query($sql); 
        $total = mysql_num_rows($result); 
        $page = ($_GET['page'])?$_GET['page']:1;
        $pageSize = 10; // 페이지당 보여줄 게시글 수 
        $blockSize = 5; // 블록 당 페이지 수
        $pageN = ceil($total/$pageSize); // 총 페이지 
        $block = ceil($pageN/$blockSize); 
        $nowBlock = ceil($page/$blockSize); // 현재 위치한 블록 체크 
        $start_p = ($nowBlock*$blockSize)-($blockSize-1); 
        if($start_p <= 1){
            $start_p = 1;
        }
        
        $end_p = $nowBlock * $blockSize;
        
        if($pageN <= $end_p){
            $end_p = $pageN;
        }

        

        return array('sql'=>$query,'result'=>$result,'total'=>$total,'start'=>$start_p,'end'=>$end_p,'page'=>$page,'where'=>$where,'where2'=>$where2);
    }


    // 글쓰기
    public function write(){

    }

    //수정
    public function update(){

    }

    //화면단
    public function view($no){
        $test = "SELECT * from tb_review_file WHERE board_no = '$no'";
        $rst = mysql_query($test);
        $tRow = mysql_fetch_row($rst);
        if($tRow == 0){
        $sql = "SELECT * 
                FROM tb_review r
                INNER JOIN tb_lecture l 
                ON r.lecture_no = l.lecture_no 
                INNER JOIN tb_file f 
                ON l.file_no = f.file_no 
                WHERE r.board_no = '$no'";
        }else{
            $sql = "SELECT * 
                FROM tb_review r
                INNER JOIN tb_review_file rf
                ON r.board_no = rf.board_no
                INNER JOIN tb_lecture l 
                ON r.lecture_no = l.lecture_no 
                INNER JOIN tb_file f 
                ON l.file_no = f.file_no 
                WHERE r.board_no = '$no'";
        }

        
        $cnt = "update tb_review r
                set r.cnt = r.cnt+1
                where r.board_no = '$no'";
        $rst = mysql_query($cnt);
        return array($rst,$sql);
    }

}

?>

