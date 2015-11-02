#!/bin/bash
mongify translation /root/database.config > /root/translation.rb
mongify process /root/database.config /root/translation.rb 
mongo symfony-app << EOF > /root/output.json
db.form.find()
EOF
