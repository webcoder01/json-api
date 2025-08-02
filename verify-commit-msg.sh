#!/bin/sh

MESSAGE=$(cat $1)
COMMIT_FORMAT="^(feat|fix|docs|refactor|test|chore)(\((.*)\))?: (.*)$"

if ! [[ "$MESSAGE" =~ $COMMIT_FORMAT ]]; then
  echo "Your commit was rejected due to the commit message. Skipping..."
  echo ""
  echo "Please use the following format:"
  echo "feat: #1234 feature example comment"
  echo "fix(ui): #4321 bugfix example comment"
  exit 1
fi