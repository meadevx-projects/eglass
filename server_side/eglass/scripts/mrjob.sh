#!/bin/bash
hdfs dfs -rm -r /eglass_output1 /eglass_output2 /eglass_output3 /eglass_output4
sleep 5
hdfs dfs -put /opt/bitnami/apache2/htdocs/eglass/uploads/$1 /eglass_input/
sleep 5
hadoop jar /opt/bitnami/apache2/htdocs/eglass/mrjob/Cooccur.jar CooccuringWord /eglass_input/$1 /eglass_output1 /eglass_output2 /eglass_output3 /eglass_output4
sleep 5
hdfs dfs -copyToLocal /eglass_output2/part-r-00000 /opt/bitnami/apache2/htdocs/eglass/output/$1_co
sleep 5
hdfs dfs -copyToLocal /eglass_output4/part-r-00000 /opt/bitnami/apache2/htdocs/eglass/output/$1_wc

