<?php
class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target) {
        asort($nums);//var_dump($nums);
        $total=count($nums);
        $result = array();
        $i=0;

        foreach($nums as $k=>$v){
            $j=0;$i++;
            if($v>=$target ||$i==$total){break;}
            foreach($nums as $ik=>$iv){
                $j++;if($j<=$i){continue;}

                if($iv>=$target){
                    break;
                }
                $sum = $v+$iv;//var_dump($sum);
                if($sum==$target){
                    array_push($result,$k);
                    array_push($result,$ik);
                }
            }
        }
        return $result;
    }

    function twoSum2($nums, $target) {
        $result = array();
        //unset larger than target
        foreach($nums as $k=>$v){
            if($v<=$target){
                continue;
            }
            else{
                unset($nums[$k]);
            }
        }
        //asort($nums);var_dump($nums);
        while($nums && count($nums)>1){
            $i = 0;
            foreach($nums as $k=>$v){
                $i++;
                if($i==1){
                    unset($nums[$k]);
                    $first = $v;
                    $first_key = $k;
                }
                else if($first+$v==$target){
                    array_push($result,$first_key);
                    array_push($result,$k);
                    unset($nums[$k]);break;
                }
            }
        }
        return $result;
    }

    function twoSum3($nums, $target) {
        $result = array();
        //asort($nums);var_dump($nums);
        $i=0;$total = count($nums);
        foreach($nums as $k=>$v){
            $i++;
            if($i==$total || $v>$target){
                unset($nums[$k]);continue;
                //break;
            }
            unset($nums[$k]);
            $rest = $target-$v;
            if($key=array_search($rest,$nums)){
                array_push($result,$k);
                array_push($result,$key);
                unset($nums[$key]);continue;
            }
        }
        return $result;
    }
}

$nums = array(2, 9,'3'=> 2,0, 'a'=>1, 8, 7, 11, 15);
$target = 9;
$obj = new Solution;
$ret = $obj->twoSum2($nums,$target);

var_dump($ret);
