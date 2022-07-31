#!/bin/bash
sh /opt/bitnami/apache2/htdocs/eglass/scripts/mrjob.sh "$(< /opt/bitnami/apache2/htdocs/eglass/output/fileprocess.txt).txt"
