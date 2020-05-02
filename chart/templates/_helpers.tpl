{{/* vim: set filetype=mustache: */}}
{{/**********************************************************/}}

{{- define "quiz-time.labels" -}}
{{ include "quiz-time.selectorLabels" . }}
{{- if .Chart.AppVersion }}
app.kubernetes.io/version: {{ .Chart.AppVersion | quote }}
{{- end }}
{{- end -}}

{{/*
Selector labels
*/}}
{{- define "quiz-time.selectorLabels" -}}
app.kubernetes.io/name: {{ .Values.quiz_time.name }}
{{- end -}}

{{/************************************************************/}}

{{- define "mysql.labels" -}}
{{ include "mysql.selectorLabels" . }}
{{- if .Chart.AppVersion }}
app.kubernetes.io/version: {{ .Chart.AppVersion | quote }}
{{- end }}
{{- end -}}

{{/*
Selector labels
*/}}
{{- define "mysql.selectorLabels" -}}
app.kubernetes.io/name: {{ .Values.mysql.name }}
{{- end -}}