
# Check the current state of the repository
# This shows modified, staged, and untracked files
git status

# Stage a specific file to prepare it for commit
git add README.md

# Check the status again to confirm the file is staged
git status

# Create a new commit with a message describing the change
git commit -m "readme"

# Upload the committed changes to the remote repository
git push

# Stage all changes in the repository
git add .

# Commit all staged changes with a descriptive message
git commit -m "git steps"

# Push the new commit to the remote repository
git push

# Fetch and merge the latest changes from the remote branch
git pull