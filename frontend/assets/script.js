function copyText(text) {
    navigator.clipboard.writeText(text)
        .then(() => alert("✅ API Endpoint copied to clipboard!"))
        .catch(() => alert("❌ Failed to copy!"));
}