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
                unset($nums[$key]);
            }
        }
        return $result;
    }

    /**
     * no repeat substring
     * @param String $s
     * @return Integer
     */
    function getLongestSubstring($s) {
        $result = $lengthArr = array();
        $i = 0;//substring-counts
        $charArr = str_split($s);//string to array
        $self = $charArr;//single-char is also no-repeat-substring
        while($charArr){
          foreach($charArr as $start=>$char){
              if(!isset($result[$i])){
                  $result[$i] = array();
                  $j = 0;//every-substring-length
              }
              if(in_array($char,$result[$i])){
                  if($j == 1){
                    unset($self[$i]);
                  }
                  else{
                    $self[$i] = array($self[$i]);
                  }
                  $lengthArr[$i] = $j;//count($result[$i]);
                  $i++;
                  $j = 0;
                  unset($charArr[0]);//from left to right
                  $charArr = array_values($charArr);
                  break;
              }
              $result[$i][] = $char;
              $j++;

              if($start == count($charArr)-1){//search until the last char
                  if($j == 1){
                    unset($self[$i]);
                  }
                  else{
                    $self[$i] = array($self[$i]);
                  }

                  $i++;
                  $j = 0;
                  unset($charArr[0]);//from left to right
                  $charArr = array_values($charArr);
              }
          }
        }
        //var_dump($result);
        $lengthArr[$i] = $j;//count($result[$i]);

        //all no-repeat-substring
        $result = array_merge($result,$self);//var_dump($result);
        foreach($self as $k=>$v){
          $lengthArr[$i] = 1;
          $i++;
        }

        $max = max($lengthArr);
        $key = array_search($max,$lengthArr);
        $ret['length'] = $max;
        $ret['string'] = implode('',$result[$key]);
        return $ret;
    }

    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Float
     */
    function findMedianSortedArrays($nums1, $nums2) {
        $num = array_values(array_merge($nums1,$nums2));
        sort($num);
        $count = count($num);
        $is_ord = $count%2;
        if($is_ord == 0){//偶数
            $key = $count/2;
            return round(($num[$key-1]+$num[$key])/2,1);
        }
        else{//奇数
            $key = floor($count/2);
            return $num[$key];
        }
    }
}

$nums = array(2, 9,'3'=> 2,0, 'a'=>1, 8, 7, 11, 15);
$target = 9;
$obj = new Solution;
//$ret = $obj->twoSum2($nums,$target);

$s = 'pwwkew';var_dump($s);
$ret = $obj->getLongestSubstring($s);
var_dump($ret);

$nums1 = [1, 2];
$nums2 = [3, 4];
$ret = $obj->findMedianSortedArrays($nums1, $nums2);
var_dump($ret);
