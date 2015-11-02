#!/bin/bash
aws ec2 describe-instances | grep InstanceId | awk '{print $2}'|sed 's/"//'|sed 's/",//' > /tmp/instance.txt

while read instanceid; do
  aws ec2 stop-instances --instance-ids $instanceid
done </tmp/instance.txt
