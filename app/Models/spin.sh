#!/bin/bash
cols=$(tput cols)
while :; do
  for i in $(seq 1 $((RANDOM%cols))); do
    printf "\e[$((RANDOM%$(tput lines)));${i}H%02x" $((RANDOM%256))
  done
  sleep 0.04
  printf "\033[2J" # bersihkan layar sesekali untuk efek
done
