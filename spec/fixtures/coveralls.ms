token = "repo_token"
service = "travis-ci"
repositoryDirectory = "{{repositoryDirectory}}"

[reportFile]
output = "{{coverallsReportPath}}"

[reportFile.input]
type = "lcov"
file = "{{lcovReportPath}}"
